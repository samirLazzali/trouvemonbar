import json
from threading import Thread
from twarc import Twarc

class XUser(Thread):
    twarc = None
    db = None
    username = ""

    def __init__(self, username, db, limit = 0):
        Thread.__init__(self)
        self.daemon = True
        self.username = username
        self.twarc = Twarc()
        self.db = db
        self.limit = limit

    def run(self):
        print("Recherche pour {}".format(self.username))
        self.twarc.connect()
        i = 0

        for t in self.twarc.timeline(screen_name = self.username):
            i += 1
            self.db.addTweet(t)

            if self.limit > 0 and i == self.limit:
                return
