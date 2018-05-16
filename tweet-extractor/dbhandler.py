import time
import psycopg2
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
        _id = str(t["id"])[-12:]
        content = t["full_text"]
        userId = str(t['user']['id'])[-12:]

        self.addUserDirect(t["user"]["screen_name"], userId)

        if "source_status_id" in t['entities']:
            repost = str(t['entities']['source_status_id'])[-12:]
        else:
            repost = 'NULL'
            
        if repost != 'NULL':
            repost = "'" + repost + "'"

        if t['in_reply_to_status_id'] != None:
            responseTo = str(t['in_reply_to_status_id'])[-12:]
        else:
            responseTo = 'NULL'

        if repost != 'NULL':
            repost = "'" + repost + "'"

        
        SQL = "INSERT INTO Post (ID, Author, Content, Timestamp, Repost, ResponseTo) VALUES ('{id}', '{author}', '{content}', '{timestamp}', {repost}, {responseto})".format(id = _id, author = userId, content = content.replace("'", "''"), timestamp = int(time.time()), repost = repost, responseto = responseTo)
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
