student = {}

def menu():
    print('''\n--- Welcome to Student Result Management System ---          
1. Add Student
2. Add Marks
3. Search Student
4. Delete Student
5. Update Student's details
6. Show all students
0. Exit''')
    choice = int(input("Enter your choice : "))

    if choice == 1:
        add_student()
    elif choice == 2:
        add_marks()
    elif choice == 3:
        search_student()
    elif choice == 4:
        delete_student()
    elif choice ==5:
        update_student()
    elif choice ==6:
        show_all()
    elif choice == 0:
        exit()
    else:
        print("Invalid input")


def add_student():
    inp = input("\nEnter last 4 digits of enrollment number : ")
    if len(inp) == 4:
        if inp in student:
            print(f"{inp} is already in list")
        else:
            name = input("Enter the name of student : ")
            student[inp] = {"Name":name,"Python":"NOT SET","Java":"NOT SET","C":"NOT SET","C++":"NOT SET"}
            print(f"Successfully added {inp} in record")
    else:
        print("Enter only last 4 digit")

def add_marks():
    inp_enrl = (input("\nEnter last 4 digits of enrollment number : "))
    if inp_enrl in student:
        if student[inp_enrl]["Python"]=="NOT SET":
            pymarks = float(input("Enter marks scored in Python : "))
            student[inp_enrl]["Python"]=pymarks
            javamarks = float(input("Enter marks scored in Java : "))
            student[inp_enrl]["Java"]=javamarks
            cmarks = float(input("Enter marks scored in C : "))
            student[inp_enrl]["C"]=cmarks
            cppmarks = float(input("Enter marks scored in C++ : "))
            student[inp_enrl]["C++"]=cppmarks

            py_marks = student[inp_enrl]["Python"]
            java_marks = student[inp_enrl]["Java"]
            c_marks = student[inp_enrl]["C"]
            cpp_marks = student[inp_enrl]["C++"]

            total_marks = (py_marks+java_marks+c_marks+cpp_marks)/4

            if total_marks >= 91 and total_marks <=100:
                print("Grade A - ",total_marks,"%")
            elif total_marks >= 81 and total_marks <=90:
                print("Grade B - ",total_marks,"%")
            elif total_marks >= 71 and total_marks <=80:
                print("Grade C - ",total_marks,"%")
            elif total_marks >= 61 and total_marks <=70:
                print("Grade E - ",total_marks,"%")
            elif total_marks <= 50:
                print("Grade F - ",total_marks,"%")
        else:
            print(f"Marks already set for enrollment number :{inp_enrl}")
    else:
        print(f"{inp_enrl} not found. Please try again after adding student")
                

def search_student():
    inp = input("Enter last 4 digit of enrollment number : ")
    if inp in student:
        print(student.get(inp))
    else:
        print("Student not found.")

def delete_student():
    inp = input("Enter last 4 digit of enrollment number : ")
    if inp in student:
        student.pop(inp)
        print(f"Successfully deleted student with enrollment number {inp}")
    else:
        print(f"No such student with enrollment number {inp} found")

def update_student():
    inp = int(input('''
1. Update name
2. Update marks
0. Exit
Enter your choice : '''))
    if inp == 1:
        inp_enrl = input("Enter last 4 digits enrollment number : ")
        if inp_enrl in student:
            old_name = input("Enter name as per result : ")
            if student[inp_enrl]["Name"] == old_name:
                new_name = input("Enter revised name : ")
                student[inp_enrl]["Name"]=new_name
        else:
            print("No match found.")
    elif inp == 2:
        print('''
1. Python marks
2. Java marks
3. C marks
4. C++ marks''')
        choice = int(input("Enter your choice : "))
        inp_enrl = input("Enter last 4 digit of enrollment number : ")
        if choice == 1:
            if student[inp_enrl]["Python"]!="NOT SET":
                updated_py_marks = float(input("Enter revised Python marks : "))
                student[inp_enrl]["Python"]=updated_py_marks
            else:
                print("Marks are not set. First set marks to update")
        elif choice == 2:
            if student[inp_enrl]["Java"]!="NOT SET":
                updated_java_marks = float(input("Enter revised Java marks : "))
                student[inp_enrl]["Java"]=updated_java_marks
            else:
                print("Marks are not set. First set marks to update")
        elif choice == 3: 
            if student[inp_enrl]["C"]!="NOT SET":
                updated_c_marks = float(input("Enter revised C marks : "))
                student[inp_enrl]["C"]=updated_c_marks
            else:
                print("Marks are not set. First set marks to update")
        elif choice == 4:
            if student[inp_enrl]["C++"]!="NOT SET":
                updated_cpp_marks = float(input("Enter revised C++ marks : "))
                student[inp_enrl]["C++"]=updated_cpp_marks
            else:
                print("Marks are not set. First set marks to update")

def show_all():
    print(student)

while(1):
    menu()