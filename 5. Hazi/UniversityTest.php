<?php
include "University.php";
include "Student.php";
include "Subject.php";

//$university = new University();
//
////// Új tárgy hozzáadása
////$university->addSubject('MATH101', 'Mathematics');
////// Hiba
//////$university->addSubject('MATH101', 'Mathematics');
////
////// Hallgató hozzáadása a tárgyhoz
////$student = new Student('John Doe', '12345');
////$student1 = new Student('Johny Deep', '1254645');
////$university->addStudentOnSubject('MATH101', $student);
////$university->addStudentOnSubject('MATH101', $student1);
////
////// Hallgatók listázása a tárgyhoz
////$students = $university->getStudentsForSubject('MATH101');
////echo 'Hallgatók MATH101 tárgyhoz: <br>';
////foreach ($students as $s) {
////    echo $s->getName() . " - " . $s->getStudentNumber() . "<br>";
////}
////
////// Összes hallgató száma
////echo 'Összes hallgató száma: ' . $university->getNumberOfStudents();
////
////// print() metódus meghívása
////$university->print();


// Új egyetem létrehozása
$university = new University();

/// Új tantárgyak hozzáadása
$subject1 = $university->addSubject("101", "Matematika");
$subject2 = $university->addSubject("102", "Fizika");
$subject3 = $university->addSubject("103", "Roman");


// Hallgatók hozzáadása
$student1 = new Student("John Doe", "12364645");
$student2 = new Student("Jane Doe", "646116");
$student3 = new Student("Kovács János", "12345");
$student4 = new Student("Szabó Anna", "54321");

$university->addStudentOnSubject("101", $student1);
$university->addStudentOnSubject("101", $student2);
$university->addStudentOnSubject("101", $student3);
$university->addStudentOnSubject("101", $student4);

// Hallgatói jegyek hozzáadása
$student1->addGrade($subject1, 6);
$student1->addGrade($subject1, 8);
$student2->addGrade($subject1, 9);

// Átlagos jegyek kiíratása
echo "Átlagjegy John Doe Matematika: " . $student1->getAvgGrade() . "<br>";
echo "Átlagjegy Jane Doe Fizika: " . $student2->getAvgGrade() . "<br>";

/// Jegyek kiíratása
$student1->printGrades();
$student2->printGrades();

//// Tantárgy törlése
////A kurzus nem törölhető, mert vannak hozzá rendelve hallgatók
//try {
//    echo $university->deleteSubject($subject1);
//} catch (SubjectDeletionException $e) {
//    echo $e->getMessage();
//}


//Kurzus sikeresen törölve: Roman
try {
    echo $university->deleteSubject($subject3);
} catch (SubjectDeletionException $e) {
    echo $e->getMessage();
}

//Kurzus nem található: Roman
try {
    echo $university->deleteSubject($subject3);
} catch (SubjectDeletionException $e) {
    echo $e->getMessage();
}

// Hallgatók törlése
echo $subject1->deleteStudent("12345");  // Sikeres törlés Kovács János számára
echo $subject1->deleteStudent("54321");  // Sikeres törlés Szabó Anna számára
echo $subject1->deleteStudent("11111");  // Nem található hallgató

// Ellenőrizzük, hogy a hallgatók törölve lettek-e
$studentList = $subject1->getStudents();
echo "Jelenlegi hallgatók száma: " . count($studentList) . "<br>";

if (empty($studentList)) {
    echo "Nincs több hallgató az egyetemen.<br>";
} else {
    foreach ($studentList as $student) {
        echo "Hallgató: " . $student->getName() . " - " . $student->getStudentNumber() . "<br>";
    }
}

echo '----------------------------------------------------------------------------------------' . "<br>";

// Hallgatók hozzáadása egy listába
$students = [
    new Student("Kovács János", "12345"),
    new Student("Szabó Anna", "54321"),
    new Student("Nagy Péter", "67890")
];

// Hallgatói jegyek hozzáadása
$students[0]->addGrade($subject1, 7);
$students[0]->addGrade($subject1, 8);

$students[1]->addGrade($subject1, 9);
$students[1]->addGrade($subject1, 10);

$students[2]->addGrade($subject1, 5);
$students[2]->addGrade($subject1, 6);


// Függvény a hallgatók rendezéséhez átlagjegy szerint
function sortStudentsByAvgGrade(array $student_list): array
{
    for ($i = 0; $i < count($student_list) - 1; $i++) {
        for ($j = 0; $j < count($student_list) - $i - 1; $j++) {
            if ($student_list[$j]->getAvgGrade() < $student_list[$j + 1]->getAvgGrade()) {
                $temp = $student_list[$j];
                $student_list[$j] = $student_list[$j + 1];
                $student_list[$j + 1] = $temp;
            }
        }
    }
    return $student_list;
}

// Hallgatók rendezése és a visszaadott tömb tárolása
$rendezettHallgatok = sortStudentsByAvgGrade($students);

// Rendezett hallgatók kiíratása
echo "Átlagjegy szerint sorba rendezés: " . '<br>';
echo '<br>';
foreach ($rendezettHallgatok as $student) {
    echo "Hallgató: " . $student->getName() . " - Átlagjegy: " . $student->getAvgGrade() . "<br>";
}