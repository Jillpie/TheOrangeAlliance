#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation
from OPR import Opr
from MatchOutput import MatchOutput
from RankingsOutput import RankingsOutput
from AverageScoresOutput import AverageScoresOutput


collectionName = 'Y201702044'

print '----------ALT LAUNCHER START----------'
AverageScoresOutput(collectionName)
RankingsOutput(collectionName)
MatchOutput(collectionName)
print '----------ALT LAUNCHER END----------'



{ 
	"_id" : ObjectId("58a948ce74fece56b6c5cd28"), 
	"MetaData" : {
		"MetaData" : "RankingsOutput",
		"TimeStamp" : "anytime", 
		"DatePlace" : "Y201702255",
		"InputID" : "rainbow"
	},
	"Rankings" : {
		"Rank1" : {
			"Rank" : 1,
			"TeamNumber" : 8097,
			"TeamName" : "Botcats",
			"RecordWin" : 7,
			"RecordTie" : 1,
			"RecordLose" : 0,
			"QP" : 14,
			"RP" : 910,
			"OPR" : 120.0,
			"CCWM" : 40.0,
			"Growth" : 4.2,
			"AverageAUTO" : 100.0,
			"AverageDRIVER" : 60.0,
			"AverageEND" : 30,
			"AverageAccuracy" : 0.99
		} 
	}
}

{  
	"MetaData" : {
		"MetaData" : "RankingsOutput",
		"TimeStamp" : "anytime", 
		"DatePlace" : "Y201702255",
		"InputID" : "rainbow"
	},
	"Rankings" : {
		"Rank1" : {
			"Rank" : 2,
			"TeamNumber" : 10809,
			"TeamName" : "Crow Force 5",
			"RecordWin" : 6,
			"RecordTie" : 1,
			"RecordLose" : 1,
			"QP" : 16,
			"RP" : 324,
			"OPR" : 100.0,
			"CCWM" : 20.0,
			"Growth" : -0.2,
			"AverageAUTO" : 90.0,
			"AverageDRIVER" : 40.0,
			"AverageEND" : 40,
			"AverageAccuracy" : 0.86
		} 
	}
}

{ 
    "_id" : ObjectId("58aebd721a0473438935969c"), 
    "MetaData" : {
        "MetaData" : "MatchOutput", 
        "TimeStamp" : "anytime", 
        "DatePlace" : "Y201702255", 
        "InputID" : "rainbow"
    }, 
    "MatchHistory" : {
        "MatchNumber1" : {
            "AllianceRed" : {
                "TeamNumber8097" : {
                    "MatchNumber" : 1.0, 
                    "Alliance" : "Red", 
                    "TeamNumber" : 8097.0, 
                    "TeamName" : "Botcats", 
                    "ResultRed" : 290.0, 
                    "ResultBlue" : 190.0, 
                    "TeamRank" : 2.0, 
                    "OPR" : 240.0, 
                    "Score" : 280.0, 
                    "AUTO" : {
                        "Parking" : "Yes I am a park", 
                        "CenterParticles" : 3.0, 
                        "CornerParticles" : 0.0, 
                        "CapBall" : "CAT BALL!", 
                        "Beacons" : 4.0
                    }, 
                    "DRIVER" : {
                        "CenterParticles" : 29.0, 
                        "CornerParticles" : 0.0
                    }, 
                    "END" : {
                        "Beacons" : "Yes I am a bacon!", 
                        "CapBall" : "More Like CAT BALL!"
                    }
                }
            }
        },
        "MatchNumber2" : {
            "AllianceRed" : {
                "TeamNumber8097" : {
                    "MatchNumber" : 1.0, 
                    "Alliance" : "Red", 
                    "TeamNumber" : 8097.0, 
                    "TeamName" : "Botcats", 
                    "ResultRed" : 290.0, 
                    "ResultBlue" : 190.0, 
                    "TeamRank" : 2.0, 
                    "OPR" : 240.0, 
                    "Score" : 280.0, 
                    "AUTO" : {
                        "Parking" : "Yes I am a park", 
                        "CenterParticles" : 3.0, 
                        "CornerParticles" : 0.0, 
                        "CapBall" : "CAT BALL!", 
                        "Beacons" : 4.0
                    }, 
                    "DRIVER" : {
                        "CenterParticles" : 29.0, 
                        "CornerParticles" : 0.0
                    }, 
                    "END" : {
                        "Beacons" : "Yes I am a bacon!", 
                        "CapBall" : "More Like CAT BALL!"
                    }
                }
            }
        }
    }
}

{ 
    "MetaData" : {
        "MetaData" : "AverageScoresOutput", 
        "TimeStamp" : "anytime", 
        "DatePlace" : "Y201702255", 
        "InputID" : "rainbow"
    }, 
    "AverageScores" : {
        "TeamNumber8097" : {
            "TeamNumber" : 8097, 
            "TeamName" : "Botcats", 
            "AverageScores" : {
            	"AverageScore" : 290.0,
				"AverageAccuracy" : .95,
				"AverageAuto" : 100.0,
				"AverageDriver" : 67.0,
				"AverageEnd" : 35.0
            },
            "AUTO" : {
                "Parking" : {
                	"NoParking" : 0.0,
					"PartiallyCenter" : 1.0,
					"PartiallyCorner" : 0.0,
					"FullyCenter" : 0.0,
					"FullyCorner" : 0.0
                }, 
                "CenterParticles" : 3.0, 
                "CornerParticles" : 0.0, 
                "CapBall" : 1.0, 
                "Beacons" : 2.0
            }, 
            "DRIVER" : {
                "CenterParticles" : 29.0, 
                "CornerParticles" : 0.0
            }, 
            "END" : {
                "Beacons" : 3.0, 
                "CapBall" : {
                	"CapBallOnFloor" : 1.0,
					"CapBallRaised" : 0.0,
					"CapBallAboveCenter" : 0.0,
					"CapBallInCenter" : 0.0
                }
            }
        }
    }
}
Rank
MaxRank : {100.0}
MaxSoftRank : {99.0}
MinRank : {1.0}
MinSoftRank : {2.0}
RankIncerment : {.1%}
{ 
    "MetaData" : {
        "MetaData" : "“ValidationKeyHierarchy”", 
        "TimeStamp" : "anytime", 
        "InputID" : "rainbow"
    }, 
    "Hierarchy" : {
        "TypeLevel" : {
            'SuperAdmin' : NumberInt(1),
            'Admin' : NumberInt(2),
            'Moderator' : NumberInt(3),
            'SuperDefault' : NumberInt(4),
            'Default' : NumberInt(5)
        },
        "StatusLevel" : {
            'Privileged' : NumberInt(1),
            'Default' : NumberInt(2),
            'Suspended' : NumberInt(3),
            'Revoked' : NumberInt(4)
        },
        "Rank" : {
            'MaxRank' : NumberInt(1000),
            'MaxSoftRank' : NumberInt(990),
            'MinRank' : NumberInt(1),
            'MinSoftRank' : NumberInt(2),
            'RankIncerment' : NumberInt(1)
        }
    }
}



[0]Team Number Class
[1]Team Number
[2]Team Name Class
[3]Team Name
[4]Average Score Class
[5]Average Score
[6]Average Auto Class
[7]Average Auto
[8]No Parking Class
[9]No Parking
[10]Partially Center Class
[11]Partially Center
[12]Partially Corner Class
[13]Partially Corner
[14]Fully Center Class
[15]Fully Center
[16]Fully Corner Class
[17]Fully Corner
[18]Auto Center Particles Class
[19]Auto Center Particles
[20]Auto Corner Particles Class
[21]Auto Corner Particles
[22]Auto Cap Ball Class
[23]Auto Cap Ball
[24]Auto Beacons Class
[25]Auto Beacons
[26]Average Teleop Class
[27]Average Teleop
[28]Tele Center Particles Class
[29]Tele Center Particles
[30]Tele Corner Particles Class
[31]Tele Corner Particles
[32]Tele Beacons Class
[33]Tele Beacons
[34]Average End Class
[35]Average End
[36]Cap Ball On Floor Class
[37]Cap Ball On Floor
[38]Cap Ball Raised Class
[39]Cap Ball Raised
[40]Cap Ball Above Center Class
[41]Cap Ball Above Center
[42]Cap Ball In Center Class
[43]Cap Ball In Center