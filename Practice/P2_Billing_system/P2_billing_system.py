class bill:
   

    def menu(self):

        while(True):

            Need = input(("Enter the value acccording to your need :\n1. Available fruits \n2. Add fruits  \n3. Remove fruits  \n4. Search fruits  \n5. Calculate bill\n"))

            if (Need == '1'):
                self.Available_fruits()
                # break
                

            elif(Need == '2'):
                self.Buy_fruit()
                # break
                

            elif(Need == '3'):
                self.Remove_fruit()
                # break
                

            elif(Need == '4'):
                self.Search_fruit()
                # break
                
                
            elif(Need == '5'):
                self.Calculate_bill()
                # break
                

    def __init__(self):

        self.fruits = {
            "Banana": "40",
            "Apple": "50",
            "chiku": "30",
            "pineapple":"35",
            "cherry": "55",
            "kiwi": "70",
            "mango": "10",
            "Grapes":"65"
            
        }
        self.bill = 0

    def Available_fruits(self):
        print("\n")
        for key, value in self.fruits.items():
            print(key + " " + value.strip())


    def Buy_fruit(self):

        print("1.Banana\n2.Apple\n3. chiku\n4.pineapple\n5.cherry\n6.kiwi\n7.mango\n8.Grapes\n9.exit ")
        
        while(True):
            choice = int(input("Enter the fruit choice you want to buy :\n"))
            if choice == 1:
                self.bill += int(self.fruits["Banana"])

            elif choice == 2:
                self.bill += int(self.fruits["Apple"])

            elif choice == 3:
                self.bill += int(self.fruits["chiku"])

            elif choice == 4:
                self.bill += int(self.fruits["pineapple"])

            elif choice == 5:
                self.bill += int(self.fruits["cherry"])

            elif choice == 6:
                self.bill += int(self.fruits["kiwi"])

            elif choice == 7:
                self.bill += int(self.fruits["mango"])

            elif choice == 8:
                self.bill += int(self.fruits["Grapes"])

            elif choice == 9:
                print("Thank you for shopping 😊")
                break

            else:
                print("Invalid choice, try again")


            



        

obj = bill()

obj.menu()
        