<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../HW_PHP_7_Expressions/style.css">
</head>
<body>
    <?php 
        class Employee
        {
            public $first_name;
            public $last_name;
            public $age;
            public $job_id;
            public $department_id;
            public $salary;
            public $commission_pct;
        
            public function __construct($first_name, $last_name, $age, $job_id, $department_id, $salary, $commission_pct = null)
            {
                $this->first_name = $first_name;
                $this->last_name = $last_name;
                $this->age = $age;
                $this->job_id = $job_id;
                $this->department_id = $department_id;
                $this->salary = $salary;
                $this->commission_pct = $commission_pct;
            }
            public function __get($property)
            {
                if (property_exists($this, $property)) {
                    return $this->$property;
                } else {
                    trigger_error("Undefined property: " . __CLASS__ . "::$property", E_USER_NOTICE);
                    return null;
                }
            }
        
            public function __set($property, $value)
            {
                if (property_exists($this, $property)) {
                    $this->$property = $value;
                } else {
                    trigger_error("Undefined property: " . __CLASS__ . "::$property", E_USER_NOTICE);
                }
            }
            public function __toString()
            {
                return "Employee [First Name: $this->first_name, Last Name: $this->last_name, Age: $this->age, " . 
                       "Job ID: $this->job_id, Department ID: $this->department_id, Salary: $this->salary, " .
                       "Commission: " . ($this->commission_pct !== null ? $this->commission_pct : 'None') . "]";
            }
        }

        

        // Получить список с информацией обо всех сотрудниках
        function getAllEmployees($employees) {
            return $employees;
        }

        // Получить список всех сотрудников с именем 'David'
        function getEmployeesByName($employees, $name) {
            return array_filter($employees, function($employee) use ($name) {
                return preg_match("/^$name$/i", $employee->first_name);
            });
        }

        // Получить список всех сотрудников с job_id равным 'IT_PROG'
        function getEmployeesByJobId($employees, $job_id) {
            return array_filter($employees, function($employee) use ($job_id) {
                return preg_match("/^$job_id$/i", $employee->job_id);
            });
        }

        // Получить список всех сотрудников из 50го отдела (department_id) с зарплатой(salary), большей 4000
        function getEmployeesByDepartmentAndSalary($employees, $department_id, $salary) {
            return array_filter($employees, function($employee) use ($department_id, $salary) {
                return $employee->department_id == $department_id && $employee->salary > $salary;
            });
        }

        // Получить список всех сотрудников из 20го и из 30го отдела (department_id)
        function getEmployeesByDepartments($employees, $departments) {
            return array_filter($employees, function($employee) use ($departments) {
                return in_array($employee->department_id, $departments);
            });
        }

        // Получить список всех сотрудников у которых последняя буква в имени равна 'a'
        function getEmployeesByLastNameEnding($employees, $letter) {
            return array_filter($employees, function($employee) use ($letter) {
                return preg_match("/$letter$/i", $employee->first_name);
            });
        }

        // Получить список всех сотрудников из 50го и из 80го отдела (department_id) у которых есть бонус (значение в       колонке commission_pct не пустое)
        function getEmployeesByDepartmentAndCommission($employees, $departments) {
            return array_filter($employees, function($employee) use ($departments) {
                return in_array($employee->department_id, $departments) && !empty($employee->commission_pct);
            });
        }

        // Получить список всех сотрудников у которых в имени содержатся минимум 2 буквы 'n'
        function getEmployeesWithTwoNs($employees) {
            return array_filter($employees, function($employee) {
                return preg_match("/(n.*n)/i", $employee->first_name);
            });
        }
        $empl_collect = [
            new Employee('David', 'Smith', 30, 'IT_PROG', 50, 5000),
            new Employee('Anna', 'Johnson', 28, 'HR_REP', 20, 3000),
            new Employee('Nancy', 'Wilson', 40, 'SA_REP', 80, 4500, 0.15),
            new Employee('David', 'Brown', 35, 'IT_PROG', 30, 6000),
            new Employee('Linda', 'Garcia', 32, 'IT_PROG', 50, 4500),
            new Employee('John', 'Doe', 25, 'IT_PROG', 50, 5000),
            new Employee('James', 'Davis', 45, 'HR_REP', 20, 3200),
            new Employee('Michael', 'Miller', 50, 'SA_REP', 80, 4700, 0.20),
            new Employee('Patricia', 'Martinez', 38, 'IT_PROG', 30, 5100),
            new Employee('Robert', 'Rodriguez', 29, 'SA_REP', 80, 4300),
            new Employee('Jennifer', 'Lopez', 34, 'IT_PROG', 50, 5200, 0.10),
            new Employee('William', 'Hall', 27, 'HR_REP', 20, 3100),
            new Employee('Elizabeth', 'Young', 31, 'SA_REP', 80, 4600, 0.18),
            new Employee('Charles', 'Allen', 36, 'IT_PROG', 50, 5500),
            new Employee('Barbara', 'Hernandez', 33, 'HR_REP', 20, 2950),
            new Employee('Susan', 'King', 41, 'SA_REP', 80, 4900, 0.22),
            new Employee('Christopher', 'Wright', 39, 'IT_PROG', 30, 5200),
            new Employee('Jessica', 'Scott', 26, 'IT_PROG', 50, 4800),
            new Employee('Daniel', 'Green', 44, 'HR_REP', 20, 3400),
            new Employee('Paul', 'Adams', 37, 'SA_REP', 80, 4600, 0.17),
            new Employee('Karen', 'Baker', 43, 'IT_PROG', 50, 5100),
            new Employee('Sarah', 'Gonzalez', 29, 'HR_REP', 20, 2900),
            new Employee('Kevin', 'Nelson', 46, 'SA_REP', 80, 4800, 0.19),
            new Employee('Nancy', 'Carter', 42, 'IT_PROG', 30, 5500),
            new Employee('George', 'Mitchell', 35, 'HR_REP', 20, 3000),
            new Employee('Lisa', 'Perez', 30, 'IT_PROG', 50, 4700),
            new Employee('Edward', 'Roberts', 50, 'SA_REP', 80, 4900, 0.25),
            new Employee('Dorothy', 'Turner', 40, 'HR_REP', 20, 3300),
            new Employee('Matthew', 'Phillips', 48, 'IT_PROG', 50, 5300),
            new Employee('Sandra', 'Campbell', 31, 'SA_REP', 80, 4700, 0.12),
        ];
        // Получение результатов
        $allEmployees = getAllEmployees($empl_collect);
        $employeesNamedDavid = getEmployeesByName($empl_collect, 'David');
        $employeesInIT_PROG = getEmployeesByJobId($empl_collect, 'IT_PROG');
        $employeesInDept50WithHighSalary = getEmployeesByDepartmentAndSalary($empl_collect, 50, 4000);
        $employeesInDept20Or30 = getEmployeesByDepartments($empl_collect, [20, 30]);
        $employeesWithLastNameEndingInA = getEmployeesByLastNameEnding($empl_collect, 'a');
        $employeesInDept50Or80WithCommission = getEmployeesByDepartmentAndCommission($empl_collect, [50, 80]);
        $employeesWithTwoNsInName = getEmployeesWithTwoNs($empl_collect);


        
        
    ?>
    <div class="form-container">
        <?php
            function createEmployeeTable($employees, $title) {
                $html = "<div class='user-list'><h2>$title</h2>";
                $html .= "<table border='1'>";
                $html .= "<tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Age</th>
                            <th>Job ID</th>
                            <th>Department ID</th>
                            <th>Salary</th>
                            <th>Commission Pct</th>
                          </tr>";
            
                foreach ($employees as $employee) {
                    $html .= "<tr>";
                    $html .= "<td>" . htmlspecialchars($employee->first_name) . "</td>";
                    $html .= "<td>" . htmlspecialchars($employee->last_name) . "</td>";
                    $html .= "<td>" . htmlspecialchars($employee->age) . "</td>";
                    $html .= "<td>" . htmlspecialchars($employee->job_id) . "</td>";
                    $html .= "<td>" . htmlspecialchars($employee->department_id) . "</td>";
                    $html .= "<td>" . htmlspecialchars($employee->salary) . "</td>";
                    $html .= "<td>" . (isset($employee->commission_pct) ? htmlspecialchars($employee->commission_pct) :             'None') . "</td>";
                    $html .= "</tr>";
                }
            
                $html .= "</table></div>";
                return $html;
            }

        ?>
       
        <?php 
            // Вывод данных в HTML
            echo createEmployeeTable($allEmployees, 'All Employees');
            echo createEmployeeTable($employeesNamedDavid, 'Employees Named David');
            echo createEmployeeTable($employeesInIT_PROG, 'Employees in IT_PROG');
            echo createEmployeeTable($employeesInDept50WithHighSalary, 'Employees in Dept 50 with Salary >4000');
            echo createEmployeeTable($employeesInDept20Or30, 'Employees in Dept 20 or 30');
            echo createEmployeeTable($employeesWithLastNameEndingInA, 'Employees with First Name Ending in A');
            echo createEmployeeTable($employeesInDept50Or80WithCommission, 'Employees in Dept 50 or 80 withCommission');
            echo createEmployeeTable($employeesWithTwoNsInName, 'Employees with Two Ns in Name');
            
        ?>
    </div>
    <?php
        // interface IEmployees 
        // {
        //     public function create($employee) : void;
        //     public function read(int $index) : ?string;
        //     public function update(int $index, Employee $new_employee) : void;
        //     public function delete(int $index) : void;
        // }

        // class EmployeeCollect
        // {
        //     public Employee $empl_collect = [];
        //     public function __construct() {
        //         $empl_collect = [
        //             new Employee('David', 'Smith', 30, 'IT_PROG', 50, 5000),
        //             new Employee('Anna', 'Johnson', 28, 'HR_REP', 20, 3000),
        //             new Employee('Nancy', 'Wilson', 40, 'SA_REP', 80, 4500, 0.15),
        //             new Employee('David', 'Brown', 35, 'IT_PROG', 30, 6000),
        //             new Employee('Linda', 'Garcia', 32, 'IT_PROG', 50, 4500),
        //             new Employee('John', 'Doe', 25, 'IT_PROG', 50, 5000),
        //         ];
        //     }
        // }
    ?>
</body>
</html>