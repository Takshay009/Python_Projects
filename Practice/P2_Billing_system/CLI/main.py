# from logic import get_price
# from logic import buy_f

class bill:
   
    def menu(self):

        while(True):
            print("   ----- Customer Billing -----\n")
            Need = input(("Enter the value acccording to your need :\n1. Add fruits  \n2. Remove fruits  \n3. calculate Bill\n"))

            if(Need == '1'):
                self.Buy_fruit()
                # break
                

            elif(Need == '2'):
                self.remove_fruit()
                # self.Remove_fruit()
                # break

            elif(Need == '3'):
                self.final_bill()
                                      
    def __init__(self):

        self.fruits = {
            "Banana": "40",
            "Apple": "50",
            "chiku": "30",
            "pineapple":"35",
            "cherry": "55",
            "kiwi": "70",
            "mango": "100",
            "Grapes":"65"
            
        }
        self.Quantity_of_selected_fruits = []
        self.value_of_seleceted_fruit = []
        self.bill = 0
        self.is_first_bill = True
        self.is_available = False

    def final_bill(self):

        if(self.is_available == True):

            if self.is_first_bill == True:
                print()
                print("Your Bill is : ",self.bill)
                print()

            else : 
                print()
                print(" Your Updated bill is : ",self.bill)
                print()

        else:
            print()
            print("Please select the fruits and try again ")
            print()

    def Buy_fruit(self):
        # buy_f()
        print(" --- Select the fruits --- ")
        print("\n1.Banana\n2.Apple\n3.chiku\n4.pineapple\n5.cherry\n6.kiwi\n7.mango\n8.Grapes\n9.exit\n ")
        i = 0
        while(True):
            choice = int(input("Enter the fruit choice you want to buy : "))
            if choice == 1:
                Qnt = int(input("Enter the Quantity number you want : "))
                self.bill += (int(self.fruits["Banana"]) * Qnt)
                self.Quantity_of_selected_fruits.append ({ "Banana": Qnt})
                self.value_of_seleceted_fruit.append({"Banana" : 40})
                self.is_available = True
                print()

            elif choice == 2:
                Qnt = int(input("Enter the Quantity number you want : "))
                self.bill += (int(self.fruits["Apple"])* Qnt)
                self.Quantity_of_selected_fruits.append ({ "Apple": Qnt})
                self.value_of_seleceted_fruit.append({"Apple" : 50})
                self.is_available = True
                print()


            elif choice == 3:
                Qnt = int(input("Enter the Quantity number you want : "))
                self.bill += (int(self.fruits["chiku"]) * Qnt)
                self.Quantity_of_selected_fruits.append ({ "chiku": Qnt})
                self.value_of_seleceted_fruit.append({"chiku" : 30})
                self.is_available = True
                print()

            elif choice == 4:
                Qnt = int(input("Enter the Quantity number you want : "))
                self.bill += (int(self.fruits["pineapple"]) * Qnt)
                self.Quantity_of_selected_fruits.append ({ "pineapple": Qnt})
                self.value_of_seleceted_fruit.append({"pineapple" : 35})
                self.is_available = True
                print()


            elif choice == 5:
                Qnt = int(input("Enter the Quantity number you want : "))
                self.bill += (int(self.fruits["cherry"]) * Qnt)
                self.Quantity_of_selected_fruits.append ({ "cherry": Qnt})
                self.value_of_seleceted_fruit.append({"cherry" : 55})
                self.is_available = True
                print()


            elif choice == 6:
                Qnt = int(input("Enter the Quantity number you want : "))
                self.bill += (int(self.fruits["kiwi"]) * Qnt)
                self.Quantity_of_selected_fruits.append ({ "kiwi": Qnt})
                self.value_of_seleceted_fruit.append({"kiwi" : 70})
                self.is_available = True
                print()


            elif choice == 7:
                Qnt = int(input("Enter the Quantity number you want : "))
                self.bill += (int(self.fruits["mango"]) * Qnt)
                self.Quantity_of_selected_fruits.append ({ "mango": Qnt})
                self.value_of_seleceted_fruit.append({"mango" : 100})
                self.is_available = True
                print()

            elif choice == 8:
                Qnt = int(input("Enter the Quantity number you want : "))
                self.bill += (int(self.fruits["Grapes"]) * Qnt)
                self.Quantity_of_selected_fruits.append ({ "Grapes": Qnt})
                self.value_of_seleceted_fruit.append({"Grapes" : 65})
                self.is_available = True
                print()


            elif choice == 9:
                print("Thank you for shopping 😊")
                print("You will get the bill at counter \n")
                # print(self.bill)
                break

            else:
                print("Invalid choice, try again\n")


    def get_name(self,index):
        name = list(self.Quantity_of_selected_fruits[index].keys())[0]
        # print(name)
        return  name

    def remove_fruit(self):
        if self.is_available == True:

            print()
            print("Fruits selected to buy are :")
                
            # for i in range (len(list(self.Quantity_of_selected_fruits))):
            while(True):
                for item in self.Quantity_of_selected_fruits:
                    for key, value in item.items():
                        print(f"{key} - Quantity: {value}")

                print()

                j = 1
                for item in self.Quantity_of_selected_fruits:
                    for key , value in item.items():
                        print(f"Enter {j} to remove one Quantity of {key} ")
                        j= j+1
                print("E to exit")

# main code 

                try :
                    
                    print()
                    r_item = (input(""))

                    if (r_item) == "e" or (r_item) == "E":
                        break
                    else:
                        # for value in self.Quantity_of_selected_fruits:
                        value = list(self.value_of_seleceted_fruit[int(r_item)-1].values())[0]
                        for i in range(len(self.value_of_seleceted_fruit)):
                            name = self.get_name(i)
                            if int(r_item)-1 == i:
                                self.Quantity_of_selected_fruits[int(r_item)-1][name] -= 1

                        self.bill -= value
                        print("Itme remove successfully")
                        # print(self.bill)

                    self.is_first_bill = False

                except (ValueError, IndexError):
                    
                    print("\nInvalid input Try again\n")

        else:
            print()
            print("Please select the fruits and try again ")
            print()

obj = bill()

obj.menu()



# tax 
# discount