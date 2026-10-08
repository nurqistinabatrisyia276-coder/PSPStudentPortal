<?php

class Student
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
public function updateProfilePicture($student_id, $filename)
{
    $sql = "UPDATE students 
            SET profile_picture = ? 
            WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        $filename,
        $student_id
    ]);
}


    // READ - Get all students
    public function getAllStudents()
    {
        $sql = "SELECT id, name, nric, program, marks FROM students";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // READ - Get one student by ID
    public function getStudentById($id)
    {
        $sql = "SELECT * FROM students WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // READ - Get student by NRIC
    public function getStudentByNric($nric)
    {
        $sql = "SELECT * FROM students WHERE nric = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nric]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // CREATE - Add student
    public function createStudent($name, $nric, $program, $marks, $password)
    {
        $sql = "INSERT INTO students 
                (name, nric, program, marks, password)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $name,
            $nric,
            $program,
            $marks,
            $password
        ]);
    }


    // UPDATE - Update student
    public function updateStudent($id, $name, $nric, $program, $marks)
    {
        $sql = "UPDATE students
                SET name = ?, nric = ?, program = ?, marks = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $name,
            $nric,
            $program,
            $marks,
            $id
        ]);
    }
    
    // DELETE - Delete student
public function deleteStudent($id)
{
    $sql = "DELETE FROM students WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([$id]);
}


    // UPDATE - Password
    public function updatePassword($id, $hashedPassword)
    {
        $sql = "UPDATE students
                SET password = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $hashedPassword,
            $id
        ]);
    }
 
}

?>