import requests

while True:
    r = requests.get("http://localhost:8080/generatelikes")
    print(r.text)
