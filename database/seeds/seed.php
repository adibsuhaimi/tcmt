<?php

use Illuminate\Database\Seeder;
use App\Project;
use App\UserProject;
use App\Requirement;
use App\Testcase;
use App\Testresult;
use App\User;

class seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Adib Suhaimi',
               'email'=>'adibsuhaimifikri@gmail.com',
               'role'=>'Project Manager',
               'password'=> bcrypt('12345678'),
            ],
            [
                'name'=>'Hassan',
                'email'=>'hassan@gmail.com',
                'role'=>'Tester',
                'password'=> bcrypt('12345678'),
            ],
            [
                'name'=>'Mirul',
                'email'=>'mirul@gmail.com',
                 'role'=>'Tester',
                'password'=> bcrypt('12345678'),
            ],
            [
                'name'=>'Hamiza',
                'email'=>'hamiza@gmail.com',
                 'role'=>'Tester',
                'password'=> bcrypt('12345678'),
            ],
            [
                'name'=>'Raidah',
                'email'=>'raidah@gmail.com',
                 'role'=>'Tester',
                'password'=> bcrypt('12345678'),
            ],
            [
                'name'=>'Ayob',
                'email'=>'developer@gmail.com',
                 'role'=>'Developer',
                'password'=> bcrypt('12345678'),
            ],
        ];

        $project = [
            [
               'projectid'=> 1,
               'projectname'=>'MIASA',
            ],
            [
                'projectid'=> 2,
                'projectname'=>'EGV Project',
            ],
            [
                'projectid'=> 3,
                'projectname'=>'Booking System',
            ],
        ];

        $userproject = [
            [
               'id'=> 1,
               'projectid'=>1,
            ],
            [
                'id'=> 2,
                'projectid'=>1,
            ],
            [
                'id'=> 3,
                'projectid'=>1,
            ],
            [
                'id'=> 4,
                'projectid'=>1,
            ],
            [
                'id'=> 5,
                'projectid'=>1,
            ],
            [
                'id'=> 6,
                'projectid'=>1,
            ],
        ];

        $req = [
            [
               'projectid'=> 1,
               'reqreference'=>'UC 01',
               'reqtitle'=>'Apply to be volunteer',
            ],
            [
                'projectid'=> 1,
                'reqreference'=>'UC 02',
                'reqtitle'=>'Login to the system',
            ],
            [
                'projectid'=> 1,
                'reqreference'=>'UC 03',
                'reqtitle'=>'Reject or approve application of volunteer',
            ],
            [
                'projectid'=> 1,
                'reqreference'=>'UC 04',
                'reqtitle'=>'Manage interview information',
            ],
            [
                'projectid'=> 1,
                'reqreference'=>'UC 05',
                'reqtitle'=>'Assign activist to team',
            ],
            [
                'projectid'=> 1,
                'reqreference'=>'UC 06',
                'reqtitle'=>'Manage volunteer',
            ],

        ];

        


        $testcase = [
            [
               'reqid'=> 1,
               'id'=>2,
               'testcasereference'=>'UC01_TC1',
               'testcasetitle'=>'Verify user can apply to be "Aktivis" using new and valid IC number and will receive email notification',
               'testcaseprecondition'=>'a',
               'testcasestep'=>
               '1. Click either "Menjadi Aktivis" 
               2. Enter 12 numeric non-existence IC number
               3. Click "Carian" button
               4. System direct to application page
               5. Enter name
               6. Enter gender
               7. Enter phone number
               8. Enter email address
               9. Enter education level
               10. Enter oocupation
               11. Enter password
               12. Re-enter password
               13. Click "Daftar" button',
               'testcaseassign'=>'Hassan',
               'testcaseexpresult'=>'User can apply to be "Aktivis" using new and valid IC number and will receive email notification',
               'testcasepriority'=>'High',
               'testcaseexptime'=> 120,
               'updated_at' => '2021-01-27 18:58:19',
               'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 1,
                'id'=>2,
                'testcasereference'=>'UC01_TC2',
                'testcasetitle'=>'Verify user can apply to be "Ahli MIASA" using new and valid IC number and will receive email notification',
                'testcaseprecondition'=>'a',
                'testcasestep'=>
                '1. Click either "Menjadi Ahli MIASA" 
                2. Enter 12 numeric non-existence IC number
                3. Click "Carian" button
                4. System direct to application page
                5. Enter name
                6. Enter gender
                7. Enter phone number
                8. Enter email address
                9. Enter education level
                10. Enter oocupation
                11. Enter password
                12. Re-enter password
                13. Enter file attachement needed
                14. Select one of the membership
                15. Click "Daftar" button',
                'testcaseassign'=>'Hassan',
                'testcaseexpresult'=>'User can apply to be "Ahli MIASA" using new and valid IC number and will receive email notification',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
             ],
             [
                 'reqid'=> 1,
                 'id'=>2,
                 'testcasereference'=>'UC01_TC3',
                 'testcasetitle'=>'Verify user cannot apply to be volunteer using existing or invalid IC number and will receive error message for entering existing IC number or entering invalid IC number.',
                 'testcaseprecondition'=>'b',
                 'testcasestep'=>
                 '1. Click either "Menjadi Aktivis" or 
                 "Menjadi Ahli MIASA"
                2. Enter less than 12 numeric IC number or 
                existing IC number
                3. Click "Carian" button',
                 'testcaseassign'=>'Hassan',
                 'testcaseexpresult'=>'user cannot apply to be volunteer using existing or invalid IC number and will receive error message for entering existing IC number or entering invalid IC number.',
                 'testcasepriority'=>'High',
                 'testcaseexptime'=> 120,
                 'updated_at' => '2021-01-27 18:58:19',
                 'created_at' => '2021-01-27 18:58:19',
             ],
             [
                 'reqid'=> 1,
                 'id'=>2,
                 'testcasereference'=>'UC01_TC4',
                 'testcasetitle'=>'Verify user is unable to apply as volunteer and receive an error message when the compulsory parameters are left blank',
                 'testcaseprecondition'=>'c',
                 'testcasestep'=>
                 '1. Enter name or left blank
                 2. Enter gender or left blank
                 3. Enter phone number or left blank
                 4. Enter email address or left blank
                 5. Enter education level or left blank
                 6. Enter oocupation or left blank
                 7. Enter password or left blank
                 8. Re-enter password or left blank
                 9. Click "Daftar" button',
                 'testcaseassign'=>'Hassan',
                 'testcaseexpresult'=>'User is unable to apply as volunteer and receive an error message when the compulsory parameters are left blank',
                 'testcasepriority'=>'High',
                 'testcaseexptime'=> 180,
                 'updated_at' => '2021-01-27 18:58:19',
                 'created_at' => '2021-01-27 18:58:19',
             ],
             [
                 'reqid'=> 1,
                 'id'=>2,
                 'testcasereference'=>'UC01_TC5',
                 'testcasetitle'=>'Verify user is unable to apply as volunteer when invalid phone number is entered',
                 'testcaseprecondition'=>'d',
                 'testcasestep'=>
                 '1. Enter name
                 2. Enter gender
                 3. Enter 11 or less numeric phone number
                 4. Enter email address
                 5. Enter education level
                 6. Enter oocupation
                 7. Enter password
                 8. Re-enter password
                 9. Click "Daftar" button',
                 'testcaseassign'=>'Hassan',
                 'testcaseexpresult'=>'user is unable to apply as volunteer when invalid phone number is entered',
                 'testcasepriority'=>'High',
                 'testcaseexptime'=> 120,
                 'updated_at' => '2021-01-27 18:58:19',
                 'created_at' => '2021-01-27 18:58:19',
             ],
             [
                'reqid'=> 1,
                'id'=>2,
                'testcasereference'=>'UC01_TC6',
                'testcasetitle'=>'Verify user is unable to apply as volunteer when invalid email address is entered',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Enter name
                2. Enter gender
                3. Enter phone number
                4. Enter email in an invalid format.
                5. Enter education level
                6. Enter oocupation
                7. Enter password
                8. Re-enter password
                9. Click "Daftar" button',
                'testcaseassign'=>'Hassan',
                'testcaseexpresult'=>'user is unable to apply as volunteer when invalid email address is entered',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 1,
                'id'=>2,
                'testcasereference'=>'UC01_TC7',
                'testcasetitle'=>'Verify user is unable to apply as volunteer when invalid unmatch password is entered',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Enter name
                2. Enter gender
                3. Enter phone number
                4. Enter email address
                5. Enter education level
                6. Enter oocupation
                7. Enter password
                8. Re-enter invalid unmatch password
                9. Click "Daftar" button',
                'testcaseassign'=>'Hassan',
                'testcaseexpresult'=>'user is unable to apply as volunteer when invalid unmatch password is entered',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 1,
                'id'=>2,
                'testcasereference'=>'UC01_TC8',
                'testcasetitle'=>'Verify user is able to register as "Aktivis" when information input  besides IC number is the same as other users.',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click either "Menjadi Aktivis" 
                2. Enter 12 numeric non-existence IC number
                3. Click "Carian" button
                4. System direct to application page
                5. Enter name
                6. Enter gender
                7. Enter phone number
                8. Enter email address
                9. Enter education level
                10. Enter oocupation
                11. Enter password
                12. Re-enter password
                13. Click "Daftar" button',
                'testcaseassign'=>'Hassan',
                'testcaseexpresult'=>'user is able to register as "Aktivis" when information input  besides IC number is the same as other users.',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 1,
                'id'=>2,
                'testcasereference'=>'UC01_TC9',
                'testcasetitle'=>'Verify user is able to register as "Ahli MIASA" when information input  besides IC number is the same as other users.',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click either "Menjadi Ahli MIASA" 
                2. Enter 12 numeric non-existence IC number
                3. Click "Carian" button
                4. System direct to application page
                5. Enter name
                6. Enter gender
                7. Enter phone number
                8. Enter email address
                9. Enter education level
                10. Enter oocupation
                11. Enter password
                12. Re-enter password
                13. Enter file attachement needed
                14. Select one of the membership
                15. Click "Daftar" button',
                'testcaseassign'=>'Hassan',
                'testcaseexpresult'=>'user is able to register as "Ahli MIASA" when information input  besides IC number is the same as other users.',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],

            

            [
                'reqid'=> 2,
                'id'=>3,
                'testcasereference'=>'UC02_TC1',
                'testcasetitle'=>'Verify Staff is able to login to the system when the user enter valid Staff ID and correct password',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Log Masuk" and select "Staf" 
                2. Enter valid Staff ID
                3. Enter valid Password
                4. Click "Log Masuk" button',
                'testcaseassign'=>'Mirul',
                'testcaseexpresult'=>'Staff is able to login to the system when the user enter valid Staff ID and correct password',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 2,
                'id'=>3,
                'testcasereference'=>'UC02_TC2',
                'testcasetitle'=>'Verify Staff is unable to login to the system and receive an error message when the user enter invalid Staff ID and invalid password',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Log Masuk" and select "Staf" 
                2. Enter invalid Staff ID
                3. Enter invalid Password
                4. Click "Log Masuk" button',
                'testcaseassign'=>'Mirul',
                'testcaseexpresult'=>'Verify Staff is unable to login to the system and receive an error message when the user enter invalid Staff ID and invalid password',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 2,
                'id'=>3,
                'testcasereference'=>'UC02_TC3',
                'testcasetitle'=>'Verify Staff is unable to login to the system and receive an error message when the user enter invalid Staff ID and valid password',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Log Masuk" and select "Staf" 
                2. Enter invalid Staff ID
                3. Enter valid Password
                4. Click "Log Masuk" button',
                'testcaseassign'=>'Mirul',
                'testcaseexpresult'=>'Staff is unable to login to the system and receive an error message when the user enter invalid Staff ID and valid password',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 2,
                'id'=>3,
                'testcasereference'=>'UC02_TC4',
                'testcasetitle'=>'Verify Staff is unable to login to the system and receive an error message when the user enter valid Staff ID and invalid password.',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Log Masuk" and select "Staf" 
                2. Enter valid Staff ID
                3. Enter invalid Password
                4. Click "Log Masuk" button',
                'testcaseassign'=>'Mirul',
                'testcaseexpresult'=>'Staff is unable to login to the system and receive an error message when the user enter valid Staff ID and invalid password',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 2,
                'id'=>3,
                'testcasereference'=>'UC02_TC5',
                'testcasetitle'=>'Verify Staff is unable to login to the system and receive an error message when both the Staff ID and Password are left blank .',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Log Masuk" and select "Staf" 
                2. Left Staff ID field blank 
                3. Left Password field blank 
                4. Click "Log Masuk" button',
                'testcaseassign'=>'Mirul',
                'testcaseexpresult'=>'Staff is unable to login to the system and receive an error message when both the Staff ID and Password are left blank ',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 2,
                'id'=>3,
                'testcasereference'=>'UC02_TC6',
                'testcasetitle'=>'Verify Staff is unable to login to the system and receive an error message when either the Staff ID and Password are left blank .',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Log Masuk" and select "Staf" 
                2. Enter Staff ID or left blank 
                3. Enter Password or left blank 
                4. Click "Log Masuk" button',
                'testcaseassign'=>'Mirul',
                'testcaseexpresult'=>'Staff is unable to login to the system and receive an error message when either the Staff ID and Password are left blank ',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 2,
                'id'=>3,
                'testcasereference'=>'UC02_TC7',
                'testcasetitle'=>'Verify Volunteer is able to login to the system when the user enter valid IC Number and valid password',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Log Masuk" and select "Sukarelawan" 
                2. Enter valid IC number 
                3. Enter valid Password
                4. Click "Login" button',
                'testcaseassign'=>'Mirul',
                'testcaseexpresult'=>'Verify Volunteer is able to login to the system when the user enter valid IC Number and valid password',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 2,
                'id'=>3,
                'testcasereference'=>'UC02_TC8',
                'testcasetitle'=>'Verify Volunteer is unable to login to the system and receive an error message when the user enter invalid IC Number and invalid password',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Log Masuk" and select "Sukarelawan" 
                2. Enter invalid IC number 
                3. Enter invalid Password
                4. Click "Login" button',
                'testcaseassign'=>'Mirul',
                'testcaseexpresult'=>'Volunteer is unable to login to the system and receive an error message when the user enter invalid IC Number and invalid password',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 2,
                'id'=>3,
                'testcasereference'=>'UC02_TC9',
                'testcasetitle'=>'Verify Volunteer is unable to login to the system and receive an error message when the user enter invalid IC Number and valid password',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Log Masuk" and select "Sukarelawan" 
                2. Enter invalid IC number 
                3. Enter valid Password
                4. Click "Login" button',
                'testcaseassign'=>'Mirul',
                'testcaseexpresult'=>'Volunteer is unable to login to the system and receive an error message when the user enter invalid IC Number and valid password',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 2,
                'id'=>3,
                'testcasereference'=>'UC02_TC10',
                'testcasetitle'=>'Verify Volunteer is unable to login to the system and receive an error message when the user enter valid IC Number and invalid password',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Log Masuk" and select "Sukarelawan" 
                2. Enter valid IC number 
                3. Enter invalid Password
                4. Click "Login" button',
                'testcaseassign'=>'Mirul',
                'testcaseexpresult'=>'Volunteer is unable to login to the system and receive an error message when the user enter valid IC Number and invalid password',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],



            [
                'reqid'=> 3,
                'id'=>4,
                'testcasereference'=>'UC03_TC1',
                'testcasetitle'=>'Verify Staff is able to approve application of "Ahli MIASA"',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Senarai Permohonan" on sidebar menu. 
                2. Find volunteer that apply as "Ahli MIASA" and click "Butiran" button . 
                3. Click either "Terima" button',
                'testcaseassign'=>'Hamiza',
                'testcaseexpresult'=>'Staff is able to approve application of "Ahli MIASA"',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 3,
                'id'=>4,
                'testcasereference'=>'UC03_TC2',
                'testcasetitle'=>'Verify Staff is able to approve application of "Aktivis"',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Senarai Permohonan" on sidebar menu. 
                2. Find volunteer that apply as "Aktivis" and click "Butiran" button . 
                3. Click either "Terima" button',
                'testcaseassign'=>'Hamiza',
                'testcaseexpresult'=>'Staff is able to approve application of "Aktivis"',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 3,
                'id'=>4,
                'testcasereference'=>'UC03_TC3',
                'testcasetitle'=>'Verify Staff is able to reject application of "Ahli MIASA"',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Senarai Permohonan" on sidebar menu. 
                2. Find volunteer that apply as "Ahli MIASA" and click "Butiran" button . 
                3. Click either "Terima" button',
                'testcaseassign'=>'Hamiza',
                'testcaseexpresult'=>'Staff is able to reject application of "Ahli MIASA"',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 3,
                'id'=>4,
                'testcasereference'=>'UC03_TC4',
                'testcasetitle'=>'Verify Staff is able to reject application of "Aktivis"',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Senarai Permohonan" on sidebar menu. 
                2. Find volunteer that apply as "Aktivis" and click "Butiran" button . 
                3. Click either "Terima" button',
                'testcaseassign'=>'Hamiza',
                'testcaseexpresult'=>'Staff is able to reject application of "Aktivis"',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],



            [
                'reqid'=> 4,
                'id'=>4,
                'testcasereference'=>'UC04_TC1',
                'testcasetitle'=>'Verify Staff is unable to update interview information and receive an error message when the all parameters are left blank',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Left "Tempat Temuduga" field blank 
                2. Left "Tarikh Temuduga" field blank 
                3. Left "Masa Temuduga" field blank 
                4. Left "Perkara yang perlu dibawa" field blank 
                5. Click "Kemas Kini" button',
                'testcaseassign'=>'Hamiza',
                'testcaseexpresult'=>'Staff is unable to update interview information and receive an error message when the all parameters are left blank',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 4,
                'id'=>4,
                'testcasereference'=>'UC04_TC2',
                'testcasetitle'=>'Verify Staff is able to update interview information and email notification will be send to activist when compulsory parameters filled with valid input',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Enter "Tempat Temuduga" field
                2. Enter "Tarikh Temuduga" field
                3. Enter "Masa Temuduga" field
                4. Enter "Perkara yang perlu dibawa" field
                5. Click "Kemas Kini" button
                6. Receive email notification',
                'testcaseassign'=>'Hamiza',
                'testcaseexpresult'=>'Staff is able to update interview information and email notification will be send to activist when compulsory parameters filled with valid input',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 4,
                'id'=>4,
                'testcasereference'=>'UC04_TC3',
                'testcasetitle'=>'Verify Staff is unable to update interview information and receive an error message when the compulsory parameters are left blank',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Enter "Tempat Temuduga" field or left blank 
                2. Enter "Tarikh Temuduga" field or left blank 
                3. Enter "Masa Temuduga" field or left blank 
                4. Enter "Perkara yang perlu dibawa" field or left blank 
                5. Click "Kemas Kini" button',
                'testcaseassign'=>'Hamiza',
                'testcaseexpresult'=>'Staff is unable to update interview information and receive an error message when the compulsory parameters are left blank',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],


            [
                'reqid'=> 5,
                'id'=>4,
                'testcasereference'=>'UC05_TC1',
                'testcasetitle'=>'Verify Staff is able to assign one activist to only one team and email notification will be send to activist once information is filled with valid input. ',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Agihan Kumpulan" from sidebar menu
                2. Click on an activist 
                3. Select a team from the dropdown field
                4. Click "Kemas Kini" button',
                'testcaseassign'=>'Hamiza',
                'testcaseexpresult'=>'Staff is able to assign one activist to only one team and email notification will be send to activist once information is filled with valid input. ',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 120,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],



            [
                'reqid'=> 6,
                'id'=>5,
                'testcasereference'=>'UC06_TC1',
                'testcasetitle'=>'Verify Volunteer is able to update their profile information',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Kemas Kini" button from volunteer dashboard page
                2. Enter new password
                3. Re-enter new password
                4. Enter valid new phone number 
                5. Enter valid new email address 
                6. Click "Kemas Kini" button',
                'testcaseassign'=>'Raidah',
                'testcaseexpresult'=>'Volunteer is able to update their profile information',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 180,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 6,
                'id'=>5,
                'testcasereference'=>'UC06_TC2',
                'testcasetitle'=>'Verify Volunteer is unable to update their profile information and receive an error message when the compulsory parameters are left blank',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Kemas Kini" button from volunteer dashboard page
                2. Enter new password or left blank 
                3. Re-enter new password or left blank 
                4. Enter new phone number or left blank 
                5. Enter new email address or left blank 
                6. Click "Kemas Kini" button',
                'testcaseassign'=>'Raidah',
                'testcaseexpresult'=>'Volunteer is unable to update their profile information and receive an error message when the compulsory parameters are left blank',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 180,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 6,
                'id'=>5,
                'testcasereference'=>'UC06_TC3',
                'testcasetitle'=>'Verify Volunteer is unable to update their profile information when all parameters are left blank',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Kemas Kini" button from volunteer dashboard page
                2. Left new password field blank 
                3. Left re-enter new password field blank 
                4. Left new phone number field blank 
                5. Left new email address field blank 
                6. Click "Kemas Kini" button',
                'testcaseassign'=>'Raidah',
                'testcaseexpresult'=>'Volunteer is unable to update their profile information when all parameters are left blank',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 180,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 6,
                'id'=>5,
                'testcasereference'=>'UC06_TC4',
                'testcasetitle'=>'Verify Volunteer is unable to update their profile information and receive an error message when they enter invalid phone number ',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Kemas Kini" button from volunteer dashboard page
                2. Enter new password
                3. Re-enter new password
                4. Enter invalid new phone number 
                5. Enter new email address 6. Click "Kemas Kini" button',
                'testcaseassign'=>'Raidah',
                'testcaseexpresult'=>'Volunteer is unable to update their profile information and receive an error message when they enter invalid phone number',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 180,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],
            [
                'reqid'=> 6,
                'id'=>5,
                'testcasereference'=>'UC06_TC5',
                'testcasetitle'=>'Verify Volunteer is unable to update their profile information and receive an error message when they enter invalid email address',
                'testcaseprecondition'=>'d',
                'testcasestep'=>
                '1. Click "Kemas kini" button from volunteer dashboard page
                2. Enter new password
                3. Re-enter new password
                4. Enter new phone number 
                5. Enter invalid new email address 6. Click "Kemas Kini" button',
                'testcaseassign'=>'Raidah',
                'testcaseexpresult'=>'Volunteer is unable to update their profile information and receive an error message when they enter invalid email address',
                'testcasepriority'=>'High',
                'testcaseexptime'=> 180,
                'updated_at' => '2021-01-27 18:58:19',
                'created_at' => '2021-01-27 18:58:19',
            ],

         ];

         $testresult = [
            [
               'testcaseid'=> 1,
               'testresultreference'=>'STR_UC01_TC1',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'76',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
            ],
            [
                'testcaseid'=> 2,
               'testresultreference'=>'STR_UC01_TC2',
               'testresultstatus'=>'Fail',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'92',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
             ],
             [
                 'testcaseid'=> 3,
               'testresultreference'=>'STR_UC01_TC3',
               'testresultstatus'=>'Fail',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'120',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
             ],
             [
                 'testcaseid'=> 4,
               'testresultreference'=>'STR_UC01_TC4',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'211',
               'updated_at' => '2020-12-27 18:58:19',
               'created_at' => '2020-12-27 18:58:19',
             ],
             [
                 'testcaseid'=> 5,
               'testresultreference'=>'STR_UC01_TC5',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'89',
               'updated_at' => '2020-12-27 18:58:19',
               'created_at' => '2020-12-27 18:58:19',
             ],
             [
                'testcaseid'=> 6,
               'testresultreference'=>'STR_UC01_TC6',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'90',
               'updated_at' => '2021-01-27 18:58:19',
               'created_at' => '2021-01-27 18:58:19',
            ],

            

            [
                'testcaseid'=> 10,
               'testresultreference'=>'STR_UC02_TC1',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'210',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
            ],
            [
                'testcaseid'=> 11,
               'testresultreference'=>'STR_UC02_TC2',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'250',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
            ],
            [
                'testcaseid'=> 12,
               'testresultreference'=>'STR_UC02_TC3',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'193',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
            ],
            [
                'testcaseid'=> 13,
               'testresultreference'=>'STR_UC02_TC4',
               'testresultstatus'=>'Fail',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'97',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
            ],
            [
                'testcaseid'=> 14,
               'testresultreference'=>'STR_UC02_TC5',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'97',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
            ],
            [
                'testcaseid'=> 15,
               'testresultreference'=>'STR_UC02_TC6',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'152',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
            ],
            [
                'testcaseid'=> 16,
               'testresultreference'=>'STR_UC02_TC7',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'197',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
            ],
            [
                'testcaseid'=> 17,
               'testresultreference'=>'STR_UC02_TC8',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'310',
               'updated_at' => '2020-12-27 18:58:19',
               'created_at' => '2020-12-27 18:58:19',
            ],
            [
               'testcaseid'=> 18,
               'testresultreference'=>'STR_UC02_TC9',
               'testresultstatus'=>'Fail',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'98',
               'updated_at' => '2020-12-27 18:58:19',
               'created_at' => '2020-12-27 18:58:19',
            ],



            [
                'testcaseid'=> 20,
               'testresultreference'=>'STR_UC03_TC1',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'89',
               'updated_at' => '2020-12-27 18:58:19',
               'created_at' => '2020-12-27 18:58:19',
            ],
            [
                'testcaseid'=> 21,
               'testresultreference'=>'STR_UC03_TC2',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'119',
               'updated_at' => '2020-12-27 18:58:19',
               'created_at' => '2020-12-27 18:58:19',
            ],



            [
                 'testcaseid'=> 24,
               'testresultreference'=>'STR_UC04_TC1',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'215',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
            ],
            [
                 'testcaseid'=> 25,
               'testresultreference'=>'STR_UC04_TC2',
               'testresultstatus'=>'Fail',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'94',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
            ],


            [
                 'testcaseid'=> 27,
               'testresultreference'=>'STR_UC05_TC1',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'95',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
            ],



            [
                'testcaseid'=> 28,
               'testresultreference'=>'STR_UC06_TC1',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'241',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
            ],
            [
                'testcaseid'=> 29,
               'testresultreference'=>'STR_UC06_TC2',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'99',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
            ],
            [
                'testcaseid'=> 30,
               'testresultreference'=>'STR_UC06_TC3',
               'testresultstatus'=>'Pass',
               'testresultcomment'=>'',
               'testresultvisible'=> 1,
               'testresultduration'=>'140',
               'updated_at' => '2020-11-27 18:58:19',
               'created_at' => '2020-11-27 18:58:19',
            ],
            
 
        ];

        


        foreach ($user as $key => $value) 
        {
            User::create($value);
        }
        foreach ($project as $key => $value) 
        {
            Project::create($value);
        }
        foreach ($userproject as $key => $value) 
        {
            UserProject::create($value);
        }
        foreach ($req as $key => $value) 
        {
            Requirement::create($value);
        }
        foreach ($testcase as $key => $value) 
        {
            Testcase::create($value);
        }
        foreach ($testresult as $key => $value) 
        {
            Testresult::create($value);
        }
        
    }
}
