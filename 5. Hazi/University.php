<?php
include "AbstractUniversity.php";
include "SubjectDeletionException.php";

class University extends AbstractUniversity
{
    public function addSubject($code, $name): Subject
    {
        if (!$this->isSubjectExists($code, $name)) {
            $subject = new Subject($code, $name);
            $this->subjects[] = $subject;
            return $subject;
        } else {
            throw new Exception("Subject already exists!!!!!!");
        }
    }

    private function isSubjectExists($code, $name): bool
    {
        if (count($this->subjects) === 0) return false;
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() == $code && $subject->getName() == $name) {
                return true;
            }
        }
        return false;
    }

    public function getStudentsForSubject($subiectCode): array
    {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() == $subiectCode) {
                return $subject->getStudents();
            }
        }
        return [];
    }

    public function addStudentOnSubject($subjectCode, Student $student)
    {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() == $subjectCode) {
                $subject->addStudent($student->getName(), $student->getStudentNumber());
            }
        }
    }

    public function getNumberOfStudents(): int
    {
        $sum = 0;
        foreach ($this->subjects as $subject) {
            foreach ($subject->getStudents() as $student) {
                $sum++;
            }
        }
        return $sum;
    }

    public function print(): void
    {
        foreach ($this->subjects as $subject) {
            echo '<br>' . "------------------------------" . '<br>';
            echo $subject . "<br>";
        }
    }

    public function deleteSubject(Subject $subject): string
    {
        if (count($subject->getStudents()) > 0) {
            throw new SubjectDeleteException("A kurzus nem törölhető, mert vannak hozzá rendelve hallgatók.");
        }

        foreach ($this->subjects as $key => $existingSubject) {
            if ($existingSubject->getCode() === $subject->getCode() && $existingSubject->getName() === $subject->getName()) {
                unset($this->subjects[$key]);
                return "Kurzus sikeresen törölve: " . $subject->getName() . '<br>';
            }
        }
        return "Kurzus nem található: " . $subject->getName() . '<br>'; // Kurzus nem található
    }
}