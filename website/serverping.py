import socket
import struct
import json


def data_varint(value):
    """ renvoie la représentation d'un varint pour mettre dans un packet"""
    ordinal = b''
    while True:
        byte = value & 0x7F
        value >>= 7
        ordinal += struct.pack('B', byte | (0x80 if value > 0 else 0))

        if value == 0:
            break

    return ordinal


def read_varint(sock):
    """ lit un varint dans sock (entre 1 et 5 bytes) """
    data = 0
    for i in range(5):
        ordinal = sock.recv(1)

        if len(ordinal) == 0:
            break

        byte = ord(ordinal)
        data |= (byte & 0x7F) << 7*i

        if not byte & 0x80:
            break

    return data


if __name__ == '__main__':
    host = "its-tps.fr"
    port = 10001

    host_encoded = host.encode('utf8')

    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM, 0)
    sock.connect((host, port))

    # print(data_varint(1))

    data = b'\x00\x00'  # packet id = 0 / protocol version = 0

    # print("sending : ", data)
    # host name, prefixed with size as Varint
    data += data_varint(len(host_encoded)) + host_encoded
    # data += b'\x10its.u-strasbg.fr'

    # print("sending : ", data)

    data += struct.pack('H', port)  # port, as an unsigned short

    # print("sending : ", data)
    data += b'\x01'  # next status, must be 1

    # print("sending : ", data_varint(len(data)) + data)

    sock.send(data_varint(len(data)) + data)

    sock.send(b'\x01\x00')

    packet_length = read_varint(sock)
    packet_id = read_varint(sock)  # osef

    actual_packet_length = read_varint(sock)

    # print(f"total packet length : {packet_length}\nactual packet length : {actual_packet_length}")

    data_ = b''
    len_read = 0
    while(len_read < actual_packet_length):
        new_data = sock.recv(packet_length - len_read)
        # print(f'new data : {new_data}')
        len_read += len(new_data)
        data_ += new_data

    rep = json.loads(data_)
    # structure de rep :
    # {
    #     "version": {
    #         "name": "xxx",
    #         "protocol": xxx
    #     },
    #     "players": {
    #         "max": xxx,
    #         "online": xxx,
    #         "sample": [
    #             {
    #                 "name": "xxx",
    #                 "id": "xxx"
    #             }
    #         ]
    #     },
    #     "description": {
    #         "text": "xxx"
    #     },
    #     "favicon": "data:image/png;base64,<data>"
    # }
    print(f"Version : {rep['version']['name']}")
    print(
        f"Joueur(s) en ligne : {rep['players']['online']}/{rep['players']['max']}", end='')
    if rep['players']['online'] != 0:
        print(", dont :")
        for elem in rep['players']['sample']:
            print(f"    {elem['name']}")
        if len(rep['players']['sample']) == rep['players']['max']:
            print(
                f"( et {rep['players']['max'] - len(rep['players']['sample'])} autres joueurs")
    else:
        print()
