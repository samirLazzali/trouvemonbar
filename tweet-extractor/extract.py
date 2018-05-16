import time
import xuser
import xsearch
import dbhandler

db = dbhandler.DBHandler()

users = [
    "Terracid",
    "realDonaldTrump",
]

searches = [
    "ratp",
    "sncf",
    "grève"
]

for u in users:
    print(u)
    x = xuser.XUser(u, db, 10000)
    x.start()

for s in searches:
    x = xsearch.XSearch(s, db, 1000)
    x.start()

while True:
    time.sleep(1)