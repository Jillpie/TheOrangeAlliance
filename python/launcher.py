#! /usr/bin/python

import time
from pymongo import MongoClient
from pprint import pprint

class Launcher(object):

	def __init__(self):
		#MongoStuff
		client = MongoClient()
		db = client.TheOrangeAllianceTest
		collection = db.test
		self.cursor = collection.find({'MetaData.MetaData' : 'ScheduleInput'})


		

while True:

	

	time.sleep(10)

	file = open("/developer/TheOrangeAlliance/python/launcherStatus.txt","w")

	file.write('I am GRUUUUUUUUUUUUUUUU')

	file.close()
