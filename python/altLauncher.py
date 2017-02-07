#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation
from OPR import Opr
from MatchOutput import MatchOutput
from RankingsOutput import RankingsOutput
from AverageScoresOutput import AverageScoresOutput


collectionName = 'Y201702052'

print '----------ALT LAUNCHER START----------'
AverageScoresOutput(collectionName)
RankingsOutput(collectionName)
MatchOutput(collectionName)
print '----------ALT LAUNCHER END----------'


