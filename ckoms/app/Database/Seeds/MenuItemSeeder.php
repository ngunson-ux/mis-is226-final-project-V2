<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuItemSeeder extends Seeder
{

    private array $data = array(
[20001,1,'Classic Cheeseburger','Beef patty with cheese','Main Course',120,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20002,1,'Chicken Burger','Crispy chicken fillet','Main Course',110,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20003,1,'BBQ Burger','Burger with BBQ sauce','Main Course',125,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20004,1,'Double Burger','Double beef patty','Main Course',205,'Available',18, 'admin','admin','01/01/2026','01/01/2026'],
[20005,1,'Bacon Burger','Burger with bacon','Main Course',140,'Available',16, 'admin','admin','01/01/2026','01/01/2026'],
[20006,1,'Cheese Fries','Fries with cheese','Side Dish',85,'Available',10, 'admin','admin','01/01/2026','01/01/2026'],
[20007,1,'Hotdog Sandwich','Classic hotdog','Snack',90,'Available',10, 'admin','admin','01/01/2026','01/01/2026'],
[20008,1,'Chicken Sandwich','Grilled chicken','Snack',100,'Available',12, 'admin','admin','01/01/2026','01/01/2026'],
[20009,1,'Tuna Sandwich','Tuna filling','Snack',95,'Available',10, 'admin','admin','01/01/2026','01/01/2026'],
[20010,1,'Club Sandwich','Triple-layer sandwich','Snack',130,'Available',12, 'admin','admin','01/01/2026','01/01/2026'],
[20011,2,'Chicken Adobo','Filipino chicken','Main Course',130,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20012,2,'Pork Sinigang','Sour pork soup','Main Course',140,'Available',30, 'admin','admin','01/01/2026','01/01/2026'],
[20013,2,'Beef Tapa','Marinated beef','Main Course',135,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20014,2,'Lechon Kawali','Crispy pork','Main Course',180,'Available',30, 'admin','admin','01/01/2026','01/01/2026'],
[20015,2,'Chicken Inasal','Grilled chicken','Main Course',145,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20016,2,'Pancit Canton','Noodles','Main Course',110,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20017,2,'Sinigang na Hipon','Shrimp soup','Main Course',150,'Available',30, 'admin','admin','01/01/2026','01/01/2026'],
[20018,2,'Grilled Bangus','Grilled milkfish','Main Course',160,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20019,2,'Kare-Kare','Peanut stew','Main Course',170,'Available',35, 'admin','admin','01/01/2026','01/01/2026'],
[20020,2,'Bistek Tagalog','Beef steak','Main Course',150,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20021,3,'Carbonara Pasta','Creamy pasta','Main Course',150,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20022,3,'Spaghetti Bolognese','Meat sauce','Main Course',140,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20023,3,'Chicken Alfredo','Creamy chicken','Main Course',155,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20024,3,'Pesto Pasta','Basil sauce','Main Course',145,'Available',18, 'admin','admin','01/01/2026','01/01/2026'],
[20025,3,'Lasagna','Baked pasta','Main Course',170,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20026,3,'Mac and Cheese','Cheesy pasta','Main Course',130,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20027,3,'Penne Arrabiata','Spicy pasta','Main Course',135,'Available',18, 'admin','admin','01/01/2026','01/01/2026'],
[20028,3,'Fettuccine Alfredo','Creamy pasta','Main Course',150,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20029,3,'Seafood Pasta','Mixed seafood','Main Course',180,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20030,3,'Baked Ziti','Baked pasta','Main Course',160,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20031,4,'Sushi Roll','Sushi','Main Course',200,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20032,4,'Sashimi','Fresh raw fish','Main Course',220,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20033,4,'Ramen','Noodle soup','Main Course',180,'Available',30, 'admin','admin','01/01/2026','01/01/2026'],
[20034,4,'Tonkotsu Ramen','Pork broth ramen','Main Course',190,'Available',35, 'admin','admin','01/01/2026','01/01/2026'],
[20035,4,'Teriyaki Chicken','Grilled chicken','Main Course',170,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20036,4,'Tempura','Deep fried seafood','Main Course',190,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20037,4,'Gyoza','Dumplings','Appetizer',120,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20038,4,'Udon','Noodle dish','Main Course',160,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20039,4,'Miso Soup','Soybean soup','Side Dish',80,'Available',10, 'admin','admin','01/01/2026','01/01/2026'],
[20040,4,'Matcha Ice Cream','Green tea dessert','Dessert',100,'Available',5, 'admin','admin','01/01/2026','01/01/2026'],
[20041,5,'Chocolate Cake','Chocolate dessert','Dessert',100,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20042,5,'Cheesecake','Creamy cake','Dessert',120,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20043,5,'Brownies','Chocolate brownies','Dessert',80,'Available',10, 'admin','admin','01/01/2026','01/01/2026'],
[20044,5,'Cupcake','Mini cake','Dessert',60,'Available',10, 'admin','admin','01/01/2026','01/01/2026'],
[20045,5,'Red Velvet Cake','Red velvet cake','Dessert',110,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20046,5,'Ice Cream Sundae','Ice cream dessert','Dessert',90,'Available',5, 'admin','admin','01/01/2026','01/01/2026'],
[20047,5,'Apple Pie','Fruit pie','Dessert',95,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20048,5,'Banana Split','Ice cream banana','Dessert',100,'Available',10, 'admin','admin','01/01/2026','01/01/2026'],
[20049,5,'Donut','Fried dough','Dessert',50,'Available',8, 'admin','admin','01/01/2026','01/01/2026'],
[20050,5,'Pancakes','Fluffy pancakes','Dessert',90,'Available',12, 'admin','admin','01/01/2026','01/01/2026'],
[20051,5,'Strawberry Shortcake','Strawberry flavored cake','Dessert',130,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20052,5,'Blueberry Cheesecake','Cheesecake with blueberry topping','Dessert',200,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20053,5,'Mango Float','Mango dessert layers','Dessert',130,'Available',10, 'admin','admin','01/01/2026','01/01/2026'],
[20054,5,'Chocolate Mousse','Light chocolate dessert','Dessert',150,'Available',10, 'admin','admin','01/01/2026','01/01/2026'],
[20055,5,'Leche Flan','Caramel custard dessert','Dessert',80,'Available',10, 'admin','admin','01/01/2026','01/01/2026'],
[20056,1,'Grilled Chicken Plate','Grilled chicken with sides','Main Course',160,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20057,1,'Chicken Nuggets','Crispy chicken bites','Main Course',110,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20058,1,'Cheeseburger Meal','Burger with fries and drink','Main Course',180,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20059,1,'Chicken Wrap','Chicken in tortilla wrap','Main Course',120,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20060,1,'Bacon Egg Sandwich','Bacon and egg sandwich','Snack',100,'Available',10, 'admin','admin','01/01/2026','01/01/2026'],
[20061,2,'Chicken BBQ','Grilled chicken with BBQ','Main Course',150,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20062,2,'Pork BBQ','Grilled pork skewers','Main Course',140,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20063,2,'Lumpiang Shanghai','Fried spring rolls','Appetizer',100,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20064,2,'Pork Sisig','Sizzling pork dish','Main Course',160,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20065,2,'Tinola','Chicken soup','Main Course',130,'Available',30, 'admin','admin','01/01/2026','01/01/2026'],
[20066,3,'Seafood Pasta Platter','Mixed seafood pasta','Main Course',200,'Available',30, 'admin','admin','01/01/2026','01/01/2026'],
[20067,3,'Creamy Mushroom Pasta','Mushroom-based pasta','Main Course',150,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20068,3,'Spicy Arrabiata','Spicy tomato pasta','Main Course',140,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20069,3,'Chicken Pesto Pasta','Pesto chicken pasta','Main Course',160,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20070,3,'Cheesy Baked Pasta','Baked cheesy pasta','Main Course',170,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20071,4,'Ebi Tempura','Shrimp tempura','Main Course',200,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20072,4,'Chicken Teriyaki Don','Teriyaki chicken rice bowl','Main Course',180,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20073,4,'Beef Yakiniku','Grilled beef','Main Course',210,'Available',30, 'admin','admin','01/01/2026','01/01/2026'],
[20074,4,'Maki Combo','Sushi assortment','Main Course',220,'Available',30, 'admin','admin','01/01/2026','01/01/2026'],
[20075,4,'Chicken Karaage','Japanese fried chicken','Main Course',170,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20076,5,'Oreo Cheesecake','Cheesecake with Oreo','Dessert',130,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20077,5,'Ube Cake','Purple yam cake','Dessert',120,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20078,5,'Choco Lava Cake','Molten chocolate cake','Dessert',150,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20079,5,'Creme Brulee','Custard dessert','Dessert',130,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20080,5,'Fruit Salad','Mixed fruit dessert','Dessert',90,'Available',10, 'admin','admin','01/01/2026','01/01/2026'],
[20081,1,'Spicy Wings','Spicy chicken wings','Main Course',150,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20082,1,'Buffalo Wings','Buffalo sauce wings','Main Course',150,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20083,1,'Chicken Popcorn','Bite-sized chicken','Main Course',110,'Available',15, 'admin','admin','01/01/2026','01/01/2026'],
[20084,1,'Breakfast Platter','Eggs, bacon, toast','Main Course',160,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20085,1,'Steak and Eggs','Steak with eggs','Main Course',200,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20086,2,'Arroz Caldo','Rice porridge','Main Course',90,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20087,2,'Bulalo','Beef bone soup','Main Course',250,'Available',35, 'admin','admin','01/01/2026','01/01/2026'],
[20088,2,'Nilagang Baka','Beef soup','Main Course',250,'Available',30, 'admin','admin','01/01/2026','01/01/2026'],
[20089,2,'Tocino','Sweet cured pork','Main Course',120,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20090,2,'Longganisa','Filipino sausage','Main Course',110,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20091,3,'Vegetable Pasta','Healthy pasta','Main Course',130,'Available',18, 'admin','admin','01/01/2026','01/01/2026'],
[20092,3,'Pasta Carbonara Deluxe','Premium carbonara','Main Course',170,'Available',22, 'admin','admin','01/01/2026','01/01/2026'],
[20093,3,'Creamy Chicken Pasta','Creamy pasta with chicken','Main Course',160,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20094,3,'Seafood Alfredo','Seafood cream pasta','Main Course',180,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20095,3,'Pesto Chicken Pasta','Pesto with chicken','Main Course',165,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20096,4,'Shrimp Tempura Roll','Sushi roll with shrimp','Main Course',210,'Available',25, 'admin','admin','01/01/2026','01/01/2026'],
[20097,4,'California Roll','Crab stick sushi','Main Course',200,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20098,4,'Spicy Tuna Roll','Spicy tuna sushi','Main Course',220,'Available',20, 'admin','admin','01/01/2026','01/01/2026'],
[20099,4,'Unagi Don','Grilled eel rice bowl','Main Course',230,'Available',30, 'admin','admin','01/01/2026','01/01/2026'],
[20100,4,'Miso Ramen','Miso-based ramen','Main Course',190,'Available',30, 'admin','admin','01/01/2026','01/01/2026'],
);

    public function run()
    {
        $records = array();
        $this->db->query('SET FOREIGN_KEY_CHECKS=0;');
	$this->db->table('menu_item')->emptyTable();
	$this->db->query('SET FOREIGN_KEY_CHECKS=1;');
        for ($x = 0; $x < count($this->data); $x++) {
            $ingredient = $this->data[$x];
            $record = [
                'menu_item_id' => $ingredient[0],
                'brand_id' => $ingredient[1],
                'item_name' => $ingredient[2],
                'description' => $ingredient[3],
                'menu_category' => $ingredient[4],
                'price' => $ingredient[5],
                'availability_status' => $ingredient[6],
                'preparation_time' => $ingredient[7],
                'created_by' => $ingredient[8],
                'updated_by' => $ingredient[9],
                'date_created' => date('Y-m-d H:i:s', strtotime($ingredient[10])),
                'date_updated' => date('Y-m-d H:i:s', strtotime($ingredient[11]))    
            ];
            $records[] = $record;
        }
        $this->db->table('menu_item')->insertBatch($records);
    }
}
