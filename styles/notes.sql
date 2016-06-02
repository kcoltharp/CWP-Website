
-- classess Table
SELECT `id`, `class_num`, `class_start`, `lesson1_start`, `lesson2_start`, `legal_test_start`, `lesson3_start`, `safety_test_start`, `qual_start` FROM `classes` WHERE 1
INSERT INTO `classes`(`id`, `class_num`, `class_start`, `lesson1_start`, `lesson2_start`, `legal_test_start`, `lesson3_start`, `safety_test_start`, `qual_start`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9])
UPDATE `classes` SET `id`=[value-1],`class_num`=[value-2],`class_start`=[value-3],`lesson1_start`=[value-4],`lesson2_start`=[value-5],`legal_test_start`=[value-6],`lesson3_start`=[value-7],`safety_test_start`=[value-8],`qual_start`=[value-9] WHERE 1
DELETE FROM `classes` WHERE 1


-- scores TABLE
SELECT `id`, `class_num`, `student_num`, `legal_test_score`, `safety_test_score`, `combined_score`, `target_hits`, `pass_fail` FROM `scores` WHERE 1
INSERT INTO `scores`(`id`, `class_num`, `student_num`, `legal_test_score`, `safety_test_score`, `combined_score`, `target_hits`, `pass_fail`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])
UPDATE `scores` SET `id`=[value-1],`class_num`=[value-2],`student_num`=[value-3],`legal_test_score`=[value-4],`safety_test_score`=[value-5],`combined_score`=[value-6],`target_hits`=[value-7],`pass_fail`=[value-8] WHERE 1
DELETE FROM `scores` WHERE 1


-- students TABLE
SELECT `id`, `student_num`, `fname`, `lname`, `submissionDate`, `submissionTime` FROM `students` WHERE 1
INSERT INTO `students`(`id`, `student_num`, `fname`, `lname`, `submissionDate`, `submissionTime`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])
UPDATE `students` SET `id`=[value-1],`student_num`=[value-2],`fname`=[value-3],`lname`=[value-4],`submissionDate`=[value-5],`submissionTime`=[value-6] WHERE 1
DELETE FROM `students` WHERE 1


-- student_emergency TABLE
SELECT `id`, `student_num`, `emergencyname`, `emergencyrelation`, `emergencyaddress`, `emergencyaddress2`, `emergencycity`, `emergencystate`, `emergencyzip`, `emergencyphone`, `emergencycell`, `emergencywork` FROM `student_emergency` WHERE 1
INSERT INTO `student_emergency`(`id`, `student_num`, `emergencyname`, `emergencyrelation`, `emergencyaddress`, `emergencyaddress2`, `emergencycity`, `emergencystate`, `emergencyzip`, `emergencyphone`, `emergencycell`, `emergencywork`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
UPDATE `student_emergency` SET `id`=[value-1],`student_num`=[value-2],`emergencyname`=[value-3],`emergencyrelation`=[value-4],`emergencyaddress`=[value-5],`emergencyaddress2`=[value-6],`emergencycity`=[value-7],`emergencystate`=[value-8],`emergencyzip`=[value-9],`emergencyphone`=[value-10],`emergencycell`=[value-11],`emergencywork`=[value-12] WHERE 1


-- student_gun TABLE
SELECT `id`, `student_num`, `gunType`, `gunManufacturer`, `caliber` FROM `student_gun` WHERE 1
INSERT INTO `student_gun`(`id`, `student_num`, `gunType`, `gunManufacturer`, `caliber`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
UPDATE `student_gun` SET `id`=[value-1],`student_num`=[value-2],`gunType`=[value-3],`gunManufacturer`=[value-4],`caliber`=[value-5] WHERE 1


-- student_info TABLE
SELECT `id`, `student_num`, `sex`, `dob`, `address`, `address2`, `city`, `state`, `zip`, `email`, `hphone`, `cphone`, `lic#`, `lic_st` FROM `student_info` WHERE 1
INSERT INTO `student_info`(`id`, `student_num`, `sex`, `dob`, `address`, `address2`, `city`, `state`, `zip`, `email`, `hphone`, `cphone`, `lic#`, `lic_st`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14])
UPDATE `student_info` SET `id`=[value-1],`student_num`=[value-2],`sex`=[value-3],`dob`=[value-4],`address`=[value-5],`address2`=[value-6],`city`=[value-7],`state`=[value-8],`zip`=[value-9],`email`=[value-10],`hphone`=[value-11],`cphone`=[value-12],`lic#`=[value-13],`lic_st`=[value-14] WHERE 1


-- student_numbers
SELECT `student_num`, `class_num`, `student_name` FROM `student_numbers` WHERE 1
INSERT INTO `student_numbers`(`student_num`, `class_num`, `student_name`) VALUES ([value-1],[value-2],[value-3])
UPDATE `student_numbers` SET `student_num`=[value-1],`class_num`=[value-2],`student_name`=[value-3] WHERE 1