<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('admins')->insert([
            ['username'=>'lequanglinh', 'password'=>bcrypt('123456789')],
            ['username'=>'abcd', 'password'=>bcrypt('987654321')], 
        ]);

        DB::table('departments')->insert([
            ['name'=>'Hệ thống thông tin'],
            ['name'=>'Công nghệ phần mềm'],
            ['name'=>'year học máy tính'],
        ]);

        DB::table('teachers')->insert([
            // ['username'=>'Lê Quang Linh', 'password'=>bcrypt('123456789')],
            ['username'=>'khangdt', 'password'=>bcrypt('khangdt123'), 'name'=>'Trần Đình Khang', 'email'=>'khangdt@gmail.com', 'phone'=>'0123456789', 'id_department'=>'1', 'degree'=>'TS', 'birth'=>'1998/05/02','address'=>'Hà Nội'], 
        ]);

        DB::table('students')->insert([
            ['mssv'=>'20162404', 'name'=>'Lê Quang Linh', 'username'=>'lelinh', 'password'=>bcrypt('lelinh2016'), 'email'=>'leqlinh1998@gmail.com', 'phone'=>'0788399319', 'year'=>'K61', 'class'=>'CNTT2.02', 'birth'=>'1998/06/06', 'address'=>'Quảng Ninh'],
            ['mssv'=>'20162145', 'name'=>'Nguyễn Đình Khánh', 'username'=>'nguyenkhanh', 'password'=>bcrypt('nguyenkhanh2016'), 'email'=>'20162145@student.hust.edu.vn', 'phone'=>'0969394844', 'year'=>'K61', 'class'=>'CNTT2.02', 'birth'=>'2000/01/01', 'address'=>'Hà Nội'],
            ['mssv'=>'20162034', 'name'=>'Nguyễn Việt Hưng', 'username'=>'nguyenhung', 'password'=>bcrypt('nguyenhung2016'), 'email'=>'20162034@student.hust.edu.vn', 'phone'=>'0961613596', 'year'=>'K61', 'class'=>'CNTT2.02', 'birth'=>'2000/01/01', 'address'=>'Hà Nội'],
            ['mssv'=>'20161922', 'name'=>'Công Việt Hùng', 'username'=>'conghung', 'password'=>bcrypt('conghung2016'), 'email'=>'conghung2543@gmail.com', 'phone'=>'0969950286', 'year'=>'K61', 'class'=>'CNTT2.02', 'birth'=>'2000/01/01', 'address'=>'Hà Nội'],
            ['mssv'=>'20164797', 'name'=>'Bùi Hồng Ngọc', 'username'=>'buingoc', 'password'=>bcrypt('buingoc2016'), 'email'=>'ngoc.bh164797@sis.hust.edu.vn', 'phone'=>'0988490924', 'year'=>'K61', 'class'=>'CNTT2.02', 'birth'=>'2000/01/01', 'address'=>'Hà Nội'],
            ['mssv'=>'20161547', 'name'=>'Nguyễn Như Hiếu', 'username'=>'nguyenhieu', 'password'=>bcrypt('nguyenhieu2016'), 'email'=>'hieu650063@gmail.com', 'phone'=>'0976846979', 'year'=>'K61', 'class'=>'CNTT2.02', 'birth'=>'2000/01/01', 'address'=>'Hà Nội'],
            ['mssv'=>'20160371', 'name'=>'Nguyễn Thanh Bình', 'username'=>'nguyenbinh', 'password'=>bcrypt('nguyenbinh2016'), 'email'=>'binh.nt160371@sis.hust.edu.vn', 'phone'=>'01226398192', 'year'=>'K61', 'class'=>'CNTT2.02', 'birth'=>'2000/01/01', 'address'=>'Hà Nội'],
            ['mssv'=>'20163727', 'name'=>'Đỗ Đức Thái', 'username'=>'dothai', 'password'=>bcrypt('dothai2016'), 'email'=>'thai@gmail.com', 'phone'=>'012346579', 'year'=>'K61', 'class'=>'CNTT2.02', 'birth'=>'2000/01/01', 'address'=>'Hà Nội'],
            ['mssv'=>'20163575', 'name'=>'Trần Văn Viên', 'username'=>'tranvien', 'password'=>bcrypt('tranvien2016'), 'email'=>'vien@gmail.com', 'phone'=>'012346579', 'year'=>'K61', 'class'=>'CNTT2.02', 'birth'=>'2000/01/01', 'address'=>'Hà Nội'],
            ['mssv'=>'20163941', 'name'=>'Lê Trường Giang', 'username'=>'legiang', 'password'=>bcrypt('legiang2016'), 'email'=>'giang@gmail.com', 'phone'=>'012346579', 'year'=>'K61', 'class'=>'CNTT2.02', 'birth'=>'2000/01/01', 'address'=>'Hà Nội'],
            ['mssv'=>'20169876', 'name'=>'Nguyễn Ngọc Văn', 'username'=>'nguyenvan', 'password'=>bcrypt('nguyenvan2016'), 'email'=>'van@gmail.com', 'phone'=>'012346579', 'year'=>'K61', 'class'=>'CNTT2.02', 'birth'=>'2000/01/01', 'address'=>'Hà Nội'],
            ['mssv'=>'20183575', 'name'=>'Dương Minh Quang', 'username'=>'duongquang', 'password'=>bcrypt('duongquang'), 'email'=>'quang@gmail.com', 'phone'=>'012346579', 'year'=>'K61', 'class'=>'CNTT2.02', 'birth'=>'2000/01/01', 'address'=>'Hà Nội'],
        ]);

        DB::table('project_types')->insert([
            ['name'=>'IT3920'],
            ['name'=>'IT4421'],
        ]);

        DB::table('projects')->insert([
            ['id_teacher'=>'1', 'id_department'=>'1', 'id_project_type'=>'1', 'name'=>'Hệ thống quản lý đồ án', 'description'=>''],
            ['id_teacher'=>'1', 'id_department'=>'1', 'id_project_type'=>'2', 'name'=>'Xây dựng hệ thống chia sẻ tài liệu học tập', 'description'=>''],
            // ['id_teacher'=>'', 'id_department'=>'', 'id_project_type'=>'', 'name'=>'', 'description'=>''],
//            ['id_teacher'=>'', 'id_department'=>'', 'id_project_type'=>'', 'name'=>'', 'description'=>''],
        ]);

        DB::table('attends')->insert([
            ['id_project'=>'1', 'id_student'=>'1', 'group_name'=>''],
            ['id_project'=>'1', 'id_student'=>'2', 'group_name'=>''],
            ['id_project'=>'1', 'id_student'=>'3', 'group_name'=>''],
            ['id_project'=>'1', 'id_student'=>'4', 'group_name'=>''],
        ]);
    }
}
