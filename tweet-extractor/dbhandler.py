import time
import psycopg2
import datetime
import requests

class DBHandler():
    knownUsers = list()
    conn = None
    cur = None

    def __init__(self):
        print("Init db")
        # self.conn = psycopg2.connect(dbname = "vitz", user = "vitz", password = "assassindelapolice", port = 5431, host = "localhost")
        # self.cur = self.conn.cursor()

    def addTweet(self, t):
        timestamp = 0
        # Mon May 21 23:02:41 +0000 2018
        months = ["Jan", "Fev", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
        created_at = t["created_at"]
        created_at = "Mon May 21 23:02:41 +0000 2018"
        d = datetime.datetime.strptime(created_at, "%a %b %d %H:%M:%S %z %Y")
        print(d, created_at)
        
        print(t)
        _id = str(t["id"])[-12:]
        content = t["full_text"]
        userId = str(t['user']['id'])[-12:]

        self.addUserDirect(t["user"]["screen_name"], userId)

        if "retweeted_status" in t:
            repost = str(t['retweeted_status']['id'])[-12:]
            self.addTweet(t['retweeted_status'])
        else:
            repost = ''

        if t['in_reply_to_status_id'] != None:
            responseTo = str(t['in_reply_to_status_id'])[-12:]
        else:
            responseTo = ''

        
        SQL = "INSERT INTO Post (ID, Author, Content, Timestamp, Repost, ResponseTo) VALUES ('{id}', '{author}', '{content}', '{timestamp}', '{repost}', '{responseto}')".format(id = _id, author = userId, content = content.replace("'", "''"), timestamp = int(time.time()), repost = repost, responseto = responseTo)
        self.execute(SQL)
        

    def addUserDirect(self, name, _id):
        if _id in self.knownUsers:
            return

        email = "{}@twitter".format(name)
        self.knownUsers.append(_id)

        SQL = "INSERT INTO Users (ID, Username, Email, Password, Moderator, State) VALUES ('{}', '{}', '{}', '', false, 'active')".format(_id, name, email)
        self.execute(SQL)

    def execute(self, sql):
        req = requests.post("http://localhost:8080/api/exec", data = {'SQL' : sql})
        print(req.text)
