item = {}
cart = {}

def menu():
    # try:
        choice = int(input('''1. Add item.
2. Remove Item.
3. Calculate total.
4. Apply discount.
5. Save invoice.
6. Show all
0. Exit.
\nEnter your choice : '''))
        if choice == 1:
            add_items()
        elif choice == 2:
            remove_item()
        elif choice == 3:
            calculate_total()
        elif choice == 4:
            apply_discount()
        elif choice == 5:
            save_invoice()
        elif choice == 6:
            show_all()
        elif choice == 0:
            exit()
        else:
            print("Invalid input")
    # except ValueError:
    #     print("\nEnter only numeric value.\n")

def add_items():
    item_input = str(input("\nEnter the item name to add to inventory : ")).capitalize()
    if item_input in item:
        print(f"\n{item_input} already exists.\n")
    else:
        try:
            price = float(input(f"\nEnter price for {item_input} : "))
            qty = float(input("\nEnter quantity (only in round figures) : "))
            item[item_input] = {"Price":price,"Quantity":int(qty)}
            print(f"\nPrice {price} and Quantity {int(qty)} set for {item_input}\n")
        except ValueError:
            print("\nOnly numeric value is accepted.")
            add_items()

def remove_item():
    choice = int(input("\n1. Remove Item.\n2. Decrease quantity.\n\nEnter your choice : "))
    if choice == 1:
        try:
            rm_item = input("\nEnter the name of item you want to remove : ").capitalize()
            item.pop(rm_item)
            print(f"\nRemoved {rm_item}.\n")
        except LookupError:
            print(f"\nNo item named {rm_item} found.\n")
    elif choice == 2:
        try:
            item_name = input("\nEnter item name : ").capitalize()
            try:
                red_qty = int(input("\nEnter the quantity to reduce : "))
                item[item_name]["Quantity"] -= red_qty 
                if item[item_name]["Quantity"] <0:
                    item[item_name]["Quantity"] += red_qty
                    print("\nInsufficient quantity\n")
                else:
                    print(f"\nReduced quantity by {red_qty}.\n")
            except ValueError:
                print("\nOnly integer is allowed.\n")
                remove_item()
        except LookupError:
            print(f"No item named {item_name} found.\n")

def calculate_total():
    # print("Under construction...")
    try:
        item_name = input("\nEnter item name : ").capitalize()
        try:
            qty = int(input(f"\nEnter the quantity of {item_name} : "))
            if item[item_name]["Quantity"] <qty:
                print("\nInsufficient quantity\n")
            else:
                total_before_tax = item[item_name]["Price"] *qty
                tax = (total_before_tax*18)/100
                total_after_tax = total_before_tax+tax
                print(f"\nTotal price before tax is {total_before_tax}\n")
                print(f"\nTax @18% for {item_name} is {tax}")
                print(f"\nTotal amount payable after tax is {total_after_tax}\n")
        except ValueError:
            print("\nOnly integer is allowed\n")
    except LookupError:
        print(f"\n{item_name} does not exist.\n")

def apply_discount():
    print("Under construction...")
    

def save_invoice():
    print("Under construction...")

def show_all():
    if item == {}:
        print("\nNo item.\n")
    else:
        print(item,"\n")

while 1:
    menu()