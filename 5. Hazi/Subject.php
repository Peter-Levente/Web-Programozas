<?php

class Subject
{
    private string $code;
    private string $name;
    private array $students;

    /**
     * @param string $code
     * @param string $name
     * @param array $students
     */
    public function __construct(string $code, string $name, array $students = [])
    {
        $this->code = $code;
        $this->name = $name;
        $this->students = $students;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getStudents(): array
    {
        return $this->students;
    }

    public function setStudents(array $students): void
    {
        $this->students = $students;
    }

    public function __toString(): string
    {
        $studentDetails = [];

        // Minden hallgató nevét és számát összegyűjtjük
        foreach ($this->students as $student) {
            $studentDetails[] = $student->getName() . " - " . $student->getStudentNumber();
        }

        // Stringként megjelenítjük a tárgy kódját, nevét és a hallgatók adatait
        return "Code: " . $this->code . ", Name: " . $this->name . ", Students: " . implode(', ', $studentDetails) . "<br>";
    }

    public function addStudent($name, $studentNumber): Student
    {
        if (!$this->isStudentExists($studentNumber)) {
            $student = new Student($name, $studentNumber);
            $this->students[] = $student;
            return $student;
        } else {
            throw new Exception("Student already exists");
        }
    }

    private function isStudentExists($studentNumber): bool
    {
        foreach ($this->students as $student) {
            if ($student->getStudentNumber() == $studentNumber) {
                return true;
            }
        }
        return false;
    }

    public function deleteStudent(string $studentNumber): string
    {
        foreach ($this->students as $key => $student) {
            if ($student->getStudentNumber() == $studentNumber) {
                // Hallgató neve elmentve a törlés előtt
                $studentName = $student->getName();
                unset($this->students[$key]);
                $this->students = array_values($this->students);
                return "Hallgató sikeresen törölve: " . $studentName . " - " . $studentNumber . "<br>";
            }
        }
        return "Hallgató nem található a megadott hallgatói azonosítóval: " . $studentNumber . "<br>";
    }
}
