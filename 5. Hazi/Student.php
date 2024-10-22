<?php

class Student
{
    private $studentNumber;
    private $name;
    private array $grades = [];

    /**
     * @param $studentNumber
     * @param $name
     */
    public function __construct($name, $studentNumber)
    {
        $this->studentNumber = $studentNumber;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getStudentNumber()
    {
        return $this->studentNumber;
    }

    /**
     * @param mixed $studentNumber
     */
    public function setStudentNumber($studentNumber)
    {
        $this->studentNumber = $studentNumber;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function addGrade(Subject $subject, int $grade): string
    {
        $subjectCode = $subject->getCode();

        if (!isset($this->grades[$subjectCode])) {
            $this->grades[$subjectCode] = [];
        }

        $this->grades[$subjectCode][] = $grade;

        return "Jegy: $grade hozzáadva a(z) $subjectCode kurzushoz.";
    }

    public function getAvgGrade(): float
    {
        if (count($this->grades) === 0) {
            return 0;
        }

        $sum = 0;
        $jegyek = 0;
        foreach ($this->grades as $subjectCode => $subjectGrades) {
            foreach ($subjectGrades as $grade) {
                $jegyek += $grade; // A jegy hozzáadása az összeghez
                $sum++; // A jegyek számának növelése
            }
        }

        return $jegyek / $sum;
    }

    public function printGrades(): void
    {
        if (empty($this->grades)) {
            echo "Nincsenek jegyek a hallgatónak.\n";
        }

        echo "Hallgató: " . $this->name . " (Hallgatói szám: " . $this->studentNumber . ")\n";

        foreach ($this->grades as $subjectCode => $grade) {
            $gradesString = implode(", ", $grade);
            echo "$subjectCode: $gradesString.<br>";
        }
    }
}