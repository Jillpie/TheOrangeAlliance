#! /usr/bin/python

import time
#from pymongo import MongoClient
from pprint import pprint

print 'Start of launcher node file'
class LauncherNode(object):

	def __init__(self, inputArg):
		print 'in LauncherNode.__init__'
		#MongoStuff
		#client = MongoClient()
		#db = client.TheOrangeAllianceTest
		#collection = db.test
		#self.cursor = collection.find({'MetaData.MetaData' : 'ScheduleInput'})
		self.counter = 0
		self.inputArg = inputArg

	def runTxt(self):
		self.counter += 1
		time.sleep(10)
		file = open("/Users/michaelleonffu/Developer/TheOrangeAlliance/python/mikalDevelopment/output.txt","w")
		file.write('I am GRUUUUUUUUUUUUUUUU' + str(self.counter))
		file.close()

	def run(self):
		arg = self.inputArg
		file = open("/Users/michaelleonffu/Developer/TheOrangeAlliance/python/mikalDevelopment/output.txt","w")
		file.write('Arg is: ' + str(arg))
		print 'file wrote into txt: ' + str(arg)
		file.close()

	def getCounterValue(self):
		return self.counter

print 'End of LauncherNode file'