import json
from threading import Thread
from twarc import Twarc

class XSearch(Thread):
    twarc = None
    db = None
    search = ""

    def __init__(self, search, db, limit = 0):
        Thread.__init__(self)
        self.daemon = True
        print("Starting for {}".format(search))
        self.search = search
        self.twarc = Twarc()
        self.db = db
        self.limit = limit

    def run(self):
        self.twarc.connect()
        i = 0

        for t in self.twarc.search(self.search):
            i += 1
            self.db.addTweet(t)

            if self.limit > 0 and i == self.limit:
                return
