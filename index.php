<?php

    //Global variables that will be added up
    $totalPoints = 0;
    $totalScore = 0;
    $missPts = 0;
    $message = "";
    //Global string variables that will be concatenated to display to the user.
    $stringReport = "";
    $finalReport = "";

    //Variable that will leave the loop when it's true
    $leave = false;
    do {
        //Initialize the userInput variable.
        //This way, everytime the loop starts userInput will be initialized
        $userInput = null;

        echo "Please, enter your command in the form of (a, r, q): ";
        //Take the input from the user and converts to lowercase
        $userInput = strtolower(stream_get_line(STDIN,1024,PHP_EOL));

        switch ($userInput) {
            case "a":
                printf("%'=80s","\n\n");
                echo "Please, enter the name of the assessment: ";
                //Collects from the user the name of the assessment
                $aName = stream_get_line(STDIN,1024,PHP_EOL);

                //Concatenate with a huge string with data that
                //will be displayed with other assessments
                $stringReport .= sprintf("%'-80s","\n");
                $stringReport .= sprintf("%20s", "Assignment:");
                $stringReport .= sprintf("%40s", $aName."\n");
                /*
                ---------------------------------------------------------------
                        Assignment:                      $aName
                */
                
                echo "Please, enter the number of points of the assessment: ";
                //Collects from the user how many points from the assessment
                $aPoints = stream_get_line(STDIN,1024,PHP_EOL);
                //Adds up the totalPoints of all assessments
                $totalPoints += $aPoints;

                $stringReport .= sprintf("%20s", "Total Points:");
                $stringReport .= sprintf("%40s", $aPoints."\n");
                /*
                ---------------------------------------------------------------
                        Assignment:                      $aName
                        Total Points:                    $aPoints
                */

                echo "Was the student absent? (y/n): ";
                $studentA = strtolower(stream_get_line(STDIN,1024,PHP_EOL));
                switch ($studentA) {
                    //In case the student was not absent (n)
                    case "n":
                        $message = "Please, enter the student's score ";
                        $message .= "for the assessment $aName: ";
                        echo $message;

                        $studentScore = stream_get_line(STDIN,1024,PHP_EOL);
                        //Adds up the totalPoints the student got
                        $totalScore += $studentScore;
                        printf("%'=80s","\n\n");

                        $stringReport .= sprintf("%20s", "Total Score:");
                        $stringReport .= sprintf("%40s", $studentScore."\n");
                        $stringReport .= sprintf("%20s", "Missed:");
                        $stringReport .= sprintf("%40s", $studentA."\n");
                        break;
                    case "y":
                        printf("%'=80s","\n\n");
                        //Adds up the missPts the student missed
                        $missPts += $aPoints;

                        $stringReport .= sprintf("%20s", "Missed:");
                        $stringReport .= sprintf("%40s", $studentA."\n");
                        break;

                    defaul:
                        echo "Sorry, you misstyped! Please, type again!\n\n";
                }

                $stringReport .= sprintf("%'-80s","\n");
                $leave = false;
                break;
                /*
                ---------------------------------------------------------------
                        Assignment:                      $aName
                        Total Points:                    $aPoints
                        Total Score:                     $studentScore
                        Missed:                          $studentA
                ---------------------------------------------------------------
                */

            //In case the user types R or r
            case "r":
                //Clean the variable, if the user has requested any report
                $finalReport = "";
                $finalReport .= sprintf("%'-80s","\n");
                $finalReport .= sprintf("%40s","FINAL REPORT\n");

                //if any assessment was added to the $stringReport
                if ($stringReport != "" ) {                    
                    //Calculates the average points from the student
                    $average = sprintf("%.2f",($totalScore*100/$totalPoints));
                    $missedAvg = sprintf("%.2f",($missPts*100)/$totalPoints);

                    //Creates a Report with the average and missed points
                    $finalReport .= sprintf("%20s","Weighted Average:");
                    $finalReport .= sprintf("%40s", $average."%\n");

                    $finalReport .= sprintf("%20s","Missed Percentage:");
                    $finalReport .= sprintf("%40s",$averageMissed."%\n");
                    
                    //Create the final results, based on the assessments
                    $finalReport .= sprintf("%20s","Outcome:");
                    if ($average<50) {
                        //If the student gets less than 50%
                        $finalReport .= sprintf("%40s", "FAILED\n");
                    } else {
                        //Otherwise, the student gets at least 50%
                        $finalReport .= sprintf("%40s", "PASS\n");
                    }

                    //Display Total Report and the data about every assessment
                    echo $stringReport;
                    echo $finalReport;
                    printf("%'-80s","\n\n");

                //If no assessment was added, the average points will be 0
                //and the Outcome will be FAILED
                } else {
                    $finalReport .= sprintf("%20s","Weighted Average:");
                    $finalReport .= sprintf("%40s", "0%\n");

                    $finalReport .= sprintf("%20s","Missed Percentage:");
                    $finalReport .= sprintf("%40s","0%\n");
                    
                    $finalReport .= sprintf("%20s","Outcome:");
                    $finalReport .= sprintf("%40s", "FAILED\n");
                    $finalReport .= sprintf("%'-80s","\n");
                    echo $finalReport;
                }
                $leave = false;
                break;
                /*
                ---------------------------------------------------------------
                        Assignment:                      $aName
                        Total Points:                    $aPoints
                        Total Score:                     $studentScore
                        Missed:                          $studentA
                ---------------------------------------------------------------
                ---------------------------------------------------------------
                                            FINAL REPORT
                        Weighted Average:                 $average
                        Missed Percentage:                $averageMissed
                        Outcome:                          (PASS / FAILED)
                ---------------------------------------------------------------
                */
            //In case the user types Q or q
            case "q":
                printf("%'=80s","\n\n");
                echo "You chose quit the software!\n";
                echo "Thank you for using it!\n\n\n";
                
                //leave the loop
                $leave = true;
                break;

            //In case the user types anything other than 'a','r' or 'q'
            default:
                echo "Sorry, you misstyped! Please, type again!\n\n";
                printf("%'=80s","\n");
                $leave = false;
        }
    } while (!$leave);
