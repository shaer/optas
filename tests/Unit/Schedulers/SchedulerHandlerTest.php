<?php

namespace Tests\Unit\Schedulers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Jobs\Job;
use App\Jobs\JobRepository;
use App\Core\Exceptions\InvalidScheduleException;

class SchedulerHandlerTest extends TestCase
{
    
    private $repository;
    private $sample_model;
    
    public function setUp()
    {
        parent::setUp();
        $this->repository = new JobRepository(new Job());
        $this->sample_model = Job::all()->sortByDesc("id")->first();
    }
    
    /**
     * @dataProvider schedulerDataProvider
     */
    public function testScheduler($scheduler, $flag, $pattern = false)
    {
        $scheduler = array_replace_recursive($this->loadBasicData(), $scheduler);
        if(!$flag) {
            $this->expectException(InvalidScheduleException::class);
        }
        
        $output = $this->repository->update($this->sample_model->id, $scheduler);
        
        $this->assertEquals(true, $output);
        
        if($pattern) {
            $model = $this->sample_model->fresh();
            $this->assertEquals($pattern, $model->schedule);
        }
    }
    
    private function loadBasicData()
    {
        return [
            "scheduler" => [
                "spmd" => [
                    "exists" => "F",
                    "should_run" => "T",
                    "list" => []
                ], 
                "months" => [
                    "exists" => "F",
                    "should_run" => "T",
                    "list" => []
                ], 
                "weekly" => [
                    "exists" => "F",
                    "should_run" => "T",
                    "list" => []
                ],
                "days" => [
                    "exists" => "F",
                    "should_run" => "T",
                    "list" => []
                ],
                "everyday" => [
                    "exists" => "F",
                ],
            ]
        ];
    }
    
    public function schedulerDataProvider()
    {
        return [
            // "Valid Everyday Job" => [["scheduler" => ["everyday" => [
            //             "exists" => "T"
            //         ]
            //     ]
            // ], true, "0 0 * * *"],
    
            // "Valid Weekly job" => [["scheduler" => ["weekly" => [
            //             "exists" => "T",
            //             "should_run" => "T",
            //             "list" => [1,2,6]
            //         ]
            //     ]
            // ], true, "0 0 * * 1,2,6"],
    
            // "Invalid Weekly job" => [["scheduler" => ["weekly" => [
            //             "exists" => "T",
            //             "should_run" => "T",
            //             "list" => [8]
            //         ]
            //     ]
            // ], false],
    
            // "Valid Monthly Job" => [["scheduler" => ["spmd" => [
            //             "exists" => "T",
            //             "should_run" => "T",
            //             "list" => [3,4,5]
            //         ]
            //     ]
            // ], true, "0 0 3,4,5 * *"],
    
            // "Invalid Monthly Job" => [["scheduler" => ["spmd" => [
            //             "exists" => "T",
            //             "should_run" => "T",
            //             "list" => [95]
            //         ]
            //     ]
            // ], false],
    
            // "Specific Days in Specific Months" => [["scheduler" => ["spmd" => [
            //             "exists" => "T",
            //             "should_run" => "T",
            //             "list" => [15, 16]
            //         ], "months" => [
            //             "exists" => "T",
            //             "should_run" => "T",
            //             "list" => [1,2,3]
            //         ]
            //     ]
            // ], true, "0 0 15,16 1,2,3 *"],
    
            // "Specific Days in Specific Months and weekdays" => [["scheduler" => ["spmd" => [
            //             "exists" => "T",
            //             "should_run" => "T",
            //             "list" => [15, 16]
            //         ], "months" => [
            //             "exists" => "T",
            //             "should_run" => "T",
            //             "list" => [1,2,3]
            //         ], "weekly" => [
            //             "exists" => "T",
            //             "should_run" => "T",
            //             "list" => [1,3,4]
            //         ]
            //     ]
            // ], true, "0 0 15,16 1,2,3 1,3,4"],
    
            // "Specific Days in invalid Month" => [["scheduler" => ["spmd" => [
            //             "exists" => "T",
            //             "should_run" => "T",
            //             "list" => [15, 16]
            //         ], "months" => [
            //             "exists" => "T",
            //             "should_run" => "T",
            //             "list" => [15]
            //         ]
            //     ]
            // ], false],
    
            "Shouldn't run in specific weekdays" => [["scheduler" => ["weekly" => [
                        "exists" => "T",
                        "should_run" => "F",
                        "list" => [1,2,6]
                    ]
                ]
            ], true, "0 0 * * 0,3,4,5"],
    
            "Shouldn't run in specific months" => [["scheduler" => ["months" => [
                        "exists" => "T",
                        "should_run" => "F",
                        "list" => [1,2,6,7,8,9,10,11,12]
                    ]
                ]
            ], true, "0 0 * 3,4,5 *"],
    
            "Shouldn't run in specific month days" => [["scheduler" => ["spmd" => [
                        "exists" => "T",
                        "should_run" => "F",
                        "list" => [1,2,6,7,8,9,10,11,12,13,15,16,17,18,19,20,30]
                    ]
                ]
            ], true, "0 0 3,4,5,14,21,22,23,24,25,26,27,28,29,31 * *"],
    
            "Shouldn't run in specific month days and month" => [["scheduler" => ["spmd" => [
                        "exists" => "T",
                        "should_run" => "F",
                        "list" => [1,2,6,7,8,9,10,11,12,13,15,16,17,18,19,20,30]
                    ], "months" => [
                        "exists" => "T",
                        "should_run" => "F",
                        "list" => [1,2,6,7,8,9,10,11,12]
                    ]
                ]
            ], true, "0 0 3,4,5,14,21,22,23,24,25,26,27,28,29,31 3,4,5 *"],
    
            "Shouldn't run in specific month/week days and month" => [["scheduler" => ["spmd" => [
                        "exists" => "T",
                        "should_run" => "F",
                        "list" => [1,2,6,7,8,9,10,11,12,13,15,16,17,18,19,20,30]
                    ], "months" => [
                        "exists" => "T",
                        "should_run" => "F",
                        "list" => [1,2,6,7,8,9,10,11,12]
                    ], "weekly" => [
                        "exists" => "T",
                        "should_run" => "F",
                        "list" => [1,2,6]
                    ]
                ]
            ], true, "0 0 3,4,5,14,21,22,23,24,25,26,27,28,29,31 3,4,5 0,3,4,5"],
            "Empty Scheduler" => [["scheduler" => []
            ], true],
        ];
    }
}
