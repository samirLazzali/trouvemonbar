import time

class DBHandler():
    knownUsers = list()

    def __init__(self):
        print("Init db")

    def addTweet(self, t):
        _id = str(t["id"])[-13:]
        content = t["full_text"]

        self.addUserDirect(t["user"]["screen_name"], t["user"]["id"])

        if "source_status_id" in t['entities']:
            repost = str(t['entities']['source_status_id'])[-13:]
        else:
            repost = 'NULL'

        if t['in_reply_to_status_id'] != None:
            responseTo = str(t['in_reply_to_status_id'])[-13:]
        else:
            responseTo = 'NULL'
        
        SQL = "INSERT INTO Post (ID, Author, Content, Timestamp, Repost, ResponseTo) VALUES ('{id}', '{author}', '{content}', '{timestamp}', '{repost}', '{responseto}'".format(id = _id, author = t['user']['id'], content = content.replace("'", "''"), timestamp = int(time.time()), repost = repost, responseto = responseTo)

        print(SQL.encode("utf-8"))

    def addUserDirect(self, name, _id):
        if _id in self.knownUsers:
            return

        email = "{}@twitter".format(name)
        self.knownUsers.append(_id)

        SQL = "INSERT INTO Users (ID, Username, Email, Password, Moderator, State) VALUES ('{}', '{}', '{}', '', false, 'active')".format(_id, name, email)

        print(SQL)
        