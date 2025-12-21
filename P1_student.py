from unicodedata import name
# everthing can be done by id too 
# i start with 1 because i already have one 0 index occupide 

class SMS:
    def menu(self):

        while(True):
            choice = input(("Enter your choice:\n1. Add Student\n2. Add Marks\n3. Search Student\n4. Update Student\n5. Delete Student\n6. show all student\n7. Exit\n"))
                
            if(choice =='1'):
                self.add_student()
            
            elif(choice =='2'):
                self.add_marks()

            # elif(choice =='3'):
            #     # self.Calculate_Grade()
                                                                                                                                                           
            elif(choice =='3'):
                self.search_student()

            elif(choice =='4'):
                self.update_student()

            elif(choice =='5'):
                self.delete_student()

            elif(choice =='6'):
                self.show_all_student()
                
            elif(choice =='7'):
                print("Byeee")
                break


    def __init__(self):
        self.student_index = [
            { 
                "Name": "",
                "Marks": {
                    "Physics": 0,
                    "Chemistry": 0,
                    "Mathematics": 0
                },
                "grade": "",
                "id": 0
            }
        ] 
        
    # Main code


    def add_student(self):
       name = input("Enter the student Name :")
       id = int(input("Enter the student id :"))
       is_exist = False

       if len(self.student_index) == 1:
            self.student_index.append({
                        "Name": name,
                        "Marks": {
                                "Physics": 0,
                                "Chemistry": 0,
                                "Mathematics": 0
                            },
                            "grade": "",
                        "id": id
                    })
            print("Student added successfully\n")

       else:  
            for i in range(1,len(self.student_index)):
                if self.student_index[i]["id"] == id or self.student_index[i]["Name"] == name:
                    print("\nstudent already exist :")
                    is_exist = True
                    break
            
            if is_exist == True:
                print("Plzz change info and try again\n")

            else:
                self.student_index.append({
                        "Name": name,
                        "Marks": {
                                "Physics": 0,
                                "Chemistry": 0,
                                "Mathematics": 0
                            },
                            "grade": "",
                        "id": id
                    })
                print("Student added successfully")



            
                
    

    def add_marks(self):
        if len(self.student_index) == 1:
            print("\nThere has no any students so fist of all create one and for create one 1 dabaye\n")
        else:
            index = int(input("\nEnter the index number you want to set Marks of : "))
            p = int(input("Enter Physics Marks out of 100: "))
            c = int(input("Enter Chemistry Marks out of 100: "))
            m = int(input("Enter Mathematics Marks out of 100: "))

            if p > 100 or p < 0 or c > 100 or c < 0 or m > 100 or m < 0 :
                print("\nI told you to enter value between 0 to 100 so now gently fuck off:\n")

            else:
                self.student_index[index]["Marks"]["Physics"]  = p
                self.student_index[index]["Marks"]["Chemistry"] = c
                self.student_index[index]["Marks"]["Mathematics"] = m
                print("Marks added successfully\n")
                self.Calculate_Grade(index)
            
                


    def Calculate_Grade(self,index):

        if len(self.student_index) == 1:
            print("\nThere has no any students so fist of all create one and for create one 1 dabaye\n")
        else:
            # index = int(input("Enter the index number you want to Calculate grade : "))
            
            final_marks = (self.student_index[index]["Marks"]["Physics"] + self.student_index[index]["Marks"]["Chemistry"] + self.student_index[index]["Marks"]["Mathematics"])/3
            if final_marks >= 90:
                grade = "A+"
            elif final_marks >= 80: 
                grade = "A"
            elif final_marks >= 70:
                grade = "B"
            elif final_marks >= 60:
                grade = "C"
            elif final_marks >= 50:
                grade = "D"
            else:
                grade = "Fail"
            self.student_index[index]["grade"] = str(grade)
            # print("This student's Grade is " + self.student_index[index]["grade"] +" with " + str(final_marks) +" persent")


        
    def search_student(self):
        if len(self.student_index) == 1:
            print("\nThere has no any students so fist of all create one and for create one 1 dabaye\n")
        else:
            search_id = int(input("\nEnter student ID to search :\n"))

            for i in range (1,len(self.student_index)):

                if self.student_index[i]["id"] == search_id:
                    print("Student Found: ")
                    self.print_student_data(i)
                    break
                else:
                    continue
        




    def update_student(self):
        if len(self.student_index) == 1:
            print("\nThere has no any students so fist of all create one and create karneke liye 1 dabaye\n")
        else:
            index = int(input("Enter student inedx you want to update : "))
            # index = int(input("Enter student ID you want to update"))
            self.student_index[index]["Name"] = new_name = input("Enter new Name :")
            self.student_index[index]["id"] = new_id = input("Enter new ID :")
            self.student_index[index]["Marks"]["Physics"] = new_id = input("Enter new Physics Marks :")
            self.student_index[index]["Marks"]["Chemistry"] = new_id = input("Enter new Chemistry Marks :")
            self.student_index[index]["Marks"]["Mathematics"] = new_id = input("Enter new Mathematics Marks :")



    def delete_student(self):
        if len(self.student_index) == 1:
            print("\nThere has no any students so fist of all create one and create karneke liye 1 dabaye\n")

        else:
            delete_id = int(input("Enter the Index of student you want to remove :"))
        
            self.student_index.pop(delete_id)
            print("Student deleted successfully!")  




    def show_all_student(self):
        if len(self.student_index) == 1:
            print("\nNo record Exist\n")

        else:
            for i in range(1,len(self.student_index)):
                print("\nStudent : " + str(i))
                # print("Student name : " + self.student_index[i]["Name"])
                # print("Student id : " + str(self.student_index[i]["id"]))
                # print("Physics marks : " + str(self.student_index[i]["Marks"]["Physics"]))
                # print("Chemistry marks : " + str(self.student_index[i]["Marks"]["Chemistry"]))
                # print("Mathematics marks : " + str(self.student_index[i]["Marks"]["Mathematics"]))
                # print("Student grade : " + self.student_index[i]["grade"])
                self.print_student_data(i)
                print("------------------------------------")

    def print_student_data(self,index):
        print("\nName :"+ self.student_index[index]["Name"])
        print("ID :"+ str(self.student_index[index]["id"]))
        print("Physics Marks :"+str(self.student_index[index]["Marks"]["Physics"]))
        print("Chemistry Marks :"+str(self.student_index[index]["Marks"]["Chemistry"]))
        print("Mathamatics Marks:"+str(self.student_index[index]["Marks"]["Mathematics"]))
        print("Grade :"+self.student_index[index]["grade"])



obj = SMS()

obj.menu()
