from price import get_price

def calculate_bill():
    dic = {}

    print("1.Banana\n2.Apple\n3. chiku\n4.pineapple\n5.cherry\n6.kiwi\n7.mango\n8.Grapes\n9.exit ")
        
    while(True):
        choice = int(input("Enter the fruit choice you want to buy :\n"))
        if choice == 1:
            Qnt = int(input("Enter the Quantity number you want : "))
            bill += (int(get_price("Banana")) * Qnt)
            dic["banana"] = Qnt

        elif choice == 2:
            Qnt = int(input("Enter the Quantity number you want : "))
            bill += (int(get_price("Apple"))* Qnt)
            dic["apple"] = Qnt

        elif choice == 3:
            Qnt = int(input("Enter the Quantity number you want : "))
            bill += (int(get_price("chiku")) * Qnt)
            dic["chiku"] = Qnt


        elif choice == 4:
            Qnt = int(input("Enter the Quantity number you want : "))
            bill += (int(get_price("pineapple")) * Qnt)
            dic["pineapple"] = Qnt

        elif choice == 5:
            Qnt = int(input("Enter the Quantity number you want : "))
            bill += (int(get_price("cherry")) * Qnt)
            dic["cherry"] = Qnt

        elif choice == 6:
            Qnt = int(input("Enter the Quantity number you want : "))
            bill += (int(get_price("kiwi")) * Qnt)
            dic["kiwi"] = Qnt


        elif choice == 7:
            Qnt = int(input("Enter the Quantity number you want : "))
            bill += (int(get_price("mango")) * Qnt)
            dic["mango"] = Qnt

        elif choice == 8:
            Qnt = int(input("Enter the Quantity number you want : "))
            bill += (int(get_price("Grapes")) * Qnt)
            dic["grapes"] = Qnt

        elif choice == 9:
            print("Thank you for shopping 😊")
            print("You will get the bill at counter :")
            # print(bill)
            break

        else:
            print("Invalid choice, try again")

        return bill

    # return price * Qnt;

    


