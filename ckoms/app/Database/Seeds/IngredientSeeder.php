<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class IngredientSeeder extends Seeder
{

    private $data = array(
[1,1,'Annatto Oil','NutriSource PH','Natural annatto-infused cooking oil for authentic Filipino coloring',10,1.23,'ml','Oils & Fats',0,'admin','admin','2024-01-23 00:00:00','2024-02-24 00:00:00'],
[2,1,'Apple','Fresh Harvest',"'Crisp, farm-fresh apples sourced from Benguet highlands'",25,5.64,'g','Fresh Fruits',0,'admin','admin','2024-01-18 00:00:00','2024-04-14 00:00:00'],
[3,1,'Avocado','Green Gold Farms',"'Creamy Hass avocados, cold-chain delivered'",10,6.31,'g','Fresh Fruits',0,'admin','admin','2024-01-16 00:00:00','2024-01-20 00:00:00'],
[4,1,'BBQ Sauce','SmokeHouse PH','Rich smoky barbecue sauce with a hint of calamansi',10,2.97,'ml','Sauces & Condiments',0,'admin','admin','2024-01-31 00:00:00','2024-04-18 00:00:00'],
[5,1,'Bacon','Prime Cut Meats',"'Hickory-smoked streaky bacon, vacuum-sealed'",5,3.03,'pcs','Pork Products',0,'admin','admin','2024-02-06 00:00:00','2024-04-30 00:00:00'],
[6,1,'Banana','Dole Philippines',"'Sweet Cavendish bananas, ripe-to-order'",200,59.68,'pcs','Fresh Fruits',0,'admin','admin','2024-02-02 00:00:00','2024-03-09 00:00:00'],
[7,1,'Bangus','AquaFresh Farms',"'Farm-raised milkfish, cleaned and deboned'",5,3.91,'g','Seafood',1,'admin','admin','2024-01-20 00:00:00','2024-04-19 00:00:00'],
[8,1,'Batter','GoldenCoat Supply','All-purpose seasoned frying batter mix',200,81.25,'g','Dry Mixes',1,'admin','admin','2024-01-19 00:00:00','2024-02-16 00:00:00'],
[9,1,'Beef','Batangas Beef Co.','Premium grass-fed beef cuts from Batangas',100,19.2,'g','Beef Products',0,'admin','admin','2024-01-27 00:00:00','2024-02-09 00:00:00'],
[10,1,'Beef Patty','GrillMaster PH',"'Seasoned 100% ground beef patties, individually frozen'",100,86.27,'g','Beef Products',0,'admin','admin','2024-02-03 00:00:00','2024-03-08 00:00:00'],
[11,1,'Beef Steak','Batangas Beef Co.',"'Marbled sirloin steak cuts, chilled'",5,3.78,'g','Beef Products',0,'admin','admin','2024-02-01 00:00:00','2024-02-17 00:00:00'],
[12,1,'Blueberries','Nordic Berry Import',"'Frozen wild blueberries, IQF processed'",200,34.18,'g','Frozen Fruits',0,'admin','admin','2024-01-24 00:00:00','2024-04-14 00:00:00'],
[13,1,'Bone Marrow','Prime Cut Meats',"'Cross-cut beef bone marrow, frozen'",100,61.96,'g','Beef Products',0,'admin','admin','2024-02-06 00:00:00','2024-02-15 00:00:00'],
[14,1,'Bread','Gardenia PH',"'Soft white sandwich bread, sliced'",5,3.48,'slices','Bakery',1,'admin','admin','2024-02-08 00:00:00','2024-03-17 00:00:00'],
[15,1,'Breading','GoldenCoat Supply','Japanese-style panko breading for crispy coatings',10,8.7,'g','Dry Mixes',1,'admin','admin','2024-02-11 00:00:00','2024-02-24 00:00:00'],
[16,1,'Broth','Knorr Philippines',"'Concentrated chicken/beef broth, low-sodium'",200,70.04,'ml','Stocks & Broths',0,'admin','admin','2024-02-04 00:00:00','2024-03-22 00:00:00'],
[17,1,'Buffalo Sauce','Frank\'s RedHot','Classic cayenne pepper-based buffalo wing sauce',20,8.66,'g','Sauces & Condiments',0,'admin','admin','2024-01-21 00:00:00','2024-04-16 00:00:00'],
[18,1,'Bun','La Moderna Bakery',"'Soft sesame bun, individually wrapped'",50,36.58,'pcs','Bakery',1,'admin','admin','2024-02-05 00:00:00','2024-04-28 00:00:00'],
[19,1,'Burger Bun','La Moderna Bakery',"'Premium brioche-style burger bun, lightly toasted'",10,6.48,'pcs','Bakery',1,'admin','admin','2024-01-20 00:00:00','2024-03-29 00:00:00'],
[20,1,'Butter','Anchor Dairy NZ',"'Unsalted cultured butter, 83% fat content'",25,6.18,'g','Dairy',1,'admin','admin','2024-01-27 00:00:00','2024-03-02 00:00:00'],
[21,1,'Cake Base','BakeEase Supply',"'Pre-mixed moist sponge cake base, ready-to-bake'",25,17.9,'g','Dry Mixes',1,'admin','admin','2024-02-10 00:00:00','2024-02-18 00:00:00'],
[22,1,'Carrot','Benguet Fresh Farms',"'Organic baby carrots, washed and trimmed'",25,20.99,'g','Vegetables',0,'admin','admin','2024-02-09 00:00:00','2024-03-21 00:00:00'],
[23,1,'Cheese','Magnolia Dairy','Full-fat cheddar cheese block',200,68.19,'g','Dairy',1,'admin','admin','2024-01-21 00:00:00','2024-04-03 00:00:00'],
[24,1,'Cheese Sauce','Arla Foods','Creamy processed cheese sauce for dips and toppings',100,29.14,'g','Dairy',1,'admin','admin','2024-01-30 00:00:00','2024-03-21 00:00:00'],
[25,1,'Cheese Slice','Magnolia Dairy','Individually wrapped processed American cheese slices',500,114.29,'pcs','Dairy',1,'admin','admin','2024-01-19 00:00:00','2024-02-20 00:00:00'],
[26,1,'Chicken','San Miguel Foods',"'Fresh chilled chicken cuts, halal-certified'",50,38.62,'g','Poultry',0,'admin','admin','2024-01-28 00:00:00','2024-04-12 00:00:00'],
[27,1,'Chicken Fillet','San Miguel Foods',"'Boneless skinless chicken breast fillet, IQF'",200,85.16,'g','Poultry',0,'admin','admin','2024-01-19 00:00:00','2024-03-25 00:00:00'],
[28,1,'Chicken Patty','GrillMaster PH',"'Seasoned ground chicken patty, breaded style'",500,90.91,'g','Poultry',0,'admin','admin','2024-01-16 00:00:00','2024-01-31 00:00:00'],
[29,1,'Chicken Wings','San Miguel Foods',"'Fresh split chicken wings, chilled'",20,13.29,'g','Poultry',0,'admin','admin','2024-02-09 00:00:00','2024-05-07 00:00:00'],
[30,1,'Chili','La Pacita Spices',"'Dried red chili flakes, coarse ground'",200,127.35,'g','Spices & Seasonings',0,'admin','admin','2024-01-27 00:00:00','2024-03-16 00:00:00'],
[31,1,'Chili Mayo','Heinz Asia','Creamy mayo blend with chili for sandwiches and dips',500,288.1,'g','Sauces & Condiments',0,'admin','admin','2024-02-01 00:00:00','2024-02-03 00:00:00'],
[32,1,'Chili Sauce','Lee Kum Kee',"'Sweet chili dipping sauce, Thai-style'",10,7.14,'g','Sauces & Condiments',0,'admin','admin','2024-02-01 00:00:00','2024-03-07 00:00:00'],
[33,1,'Chocolate','Malagos Chocolate','Premium Davao dark chocolate couverture',100,20.04,'g','Confectionery',1,'admin','admin','2024-01-28 00:00:00','2024-02-18 00:00:00'],
[34,1,'Cocoa','Malagos Chocolate','100% pure unsweetened cocoa powder',500,51.46,'g','Dry Mixes',1,'admin','admin','2024-02-07 00:00:00','2024-03-12 00:00:00'],
[35,1,'Crab','SeaHarvest PH',"'Fresh mud crab, live-delivered or cleaned frozen'",20,11.14,'g','Seafood',1,'admin','admin','2024-01-18 00:00:00','2024-04-08 00:00:00'],
[36,1,'Cream','Nestle PH',"'All-purpose cooking cream, 35% fat'",50,42.88,'ml','Dairy',1,'admin','admin','2024-01-31 00:00:00','2024-04-18 00:00:00'],
[37,1,'Cream Cheese','Arla Foods','Philadelphia-style full-fat cream cheese block',25,5.94,'g','Dairy',1,'admin','admin','2024-02-08 00:00:00','2024-02-29 00:00:00'],
[38,1,'Dough','La Moderna Bakery',"'Pre-fermented pizza/bread dough, chilled'",5,3.2,'g','Bakery',1,'admin','admin','2024-01-30 00:00:00','2024-02-02 00:00:00'],
[39,1,'Dumpling Wrapper','Wing Yip Asia',"'Round gyoza/dumpling wrappers, fresh-chilled'",10,9.36,'pcs','Asian Ingredients',1,'admin','admin','2024-02-12 00:00:00','2024-03-23 00:00:00'],
[40,1,'Egg','Monterey Farms',"'Large farm-fresh eggs, Grade A'",25,3.8,'pcs','Eggs & Dairy',1,'admin','admin','2024-02-12 00:00:00','2024-04-25 00:00:00'],
[41,1,'Egg Yolk','Monterey Farms','Pasteurized separated egg yolks',10,1.77,'pcs','Eggs & Dairy',1,'admin','admin','2024-01-30 00:00:00','2024-02-08 00:00:00'],
[42,1,'Fish','AquaFresh Farms',"'Mixed whole fish, cleaned and scaled'",20,4.31,'g','Seafood',1,'admin','admin','2024-01-30 00:00:00','2024-04-10 00:00:00'],
[43,1,'Flour','Golden Wheat Mills',"'All-purpose wheat flour, bleached'",20,6.77,'g','Dry Mixes',1,'admin','admin','2024-02-11 00:00:00','2024-04-29 00:00:00'],
[44,1,'Fresh Fish','AquaFresh Farms','Daily-caught fresh saltwater fish fillets',200,193.59,'g','Seafood',1,'admin','admin','2024-02-13 00:00:00','2024-04-23 00:00:00'],
[45,1,'Fries','McCain Foods PH',"'Straight-cut frozen French fries, lightly salted'",25,18.54,'g','Frozen Goods',0,'admin','admin','2024-01-27 00:00:00','2024-04-22 00:00:00'],
[46,1,'Garlic','Ilocos Garlic Farms',"'Premium native garlic, peeled and ready-to-use'",100,49.43,'g','Vegetables',0,'admin','admin','2024-01-31 00:00:00','2024-03-29 00:00:00'],
[47,1,'Ginger','Benguet Fresh Farms',"'Fresh ginger root, peeled and sliced'",10,3.23,'g','Vegetables',0,'admin','admin','2024-01-17 00:00:00','2024-03-01 00:00:00'],
[48,1,'Graham','Monde Nissin',"'Honey graham crackers, crushed or whole'",5,3.15,'g','Baked Goods',1,'admin','admin','2024-01-22 00:00:00','2024-04-07 00:00:00'],
[49,1,'Ground Pork','Prime Cut Meats',"'Freshly ground pork shoulder, chilled'",25,2.66,'g','Pork Products',0,'admin','admin','2024-02-06 00:00:00','2024-04-27 00:00:00'],
[50,1,'Hotdog','Purefoods Star','Classic beef-pork blend frankfurter',5,1.53,'pcs','Processed Meats',1,'admin','admin','2024-02-12 00:00:00','2024-02-17 00:00:00'],
[51,1,'Ice Cream','Selecta PH',"'Creamy vanilla ice cream base, bulk tub'",100,16.38,'g','Frozen Desserts',0,'admin','admin','2024-01-22 00:00:00','2024-02-27 00:00:00'],
[52,1,'Lettuce','Tagaytay Fresh Farms',"'Crisp iceberg lettuce, pre-washed and chilled'",500,146.41,'g','Vegetables',0,'admin','admin','2024-01-19 00:00:00','2024-04-02 00:00:00'],
[53,1,'Mango','Guimaras Mango Farms',"'Sweet Carabao mangoes, ripened on-tree'",500,159.35,'g','Fresh Fruits',0,'admin','admin','2024-01-30 00:00:00','2024-03-23 00:00:00'],
[54,1,'Matcha','Ippodo Tea Japan',"'Ceremonial-grade matcha powder, stone-ground'",25,4.62,'g','Specialty Ingredients',0,'admin','admin','2024-02-05 00:00:00','2024-04-01 00:00:00'],
[55,1,'Mayo','Best Foods PH',"'Classic egg-based mayonnaise, full-fat'",100,48.12,'g','Sauces & Condiments',0,'admin','admin','2024-01-29 00:00:00','2024-02-05 00:00:00'],
[56,1,'Meat Sauce','Barilla Italy','Slow-cooked bolognese-style meat sauce',10,1.55,'g','Sauces & Condiments',0,'admin','admin','2024-02-07 00:00:00','2024-03-22 00:00:00'],
[57,1,'Milk','Anchor Dairy NZ',"'Full-cream fresh milk, pasteurized and chilled'",10,3.24,'ml','Dairy',1,'admin','admin','2024-01-21 00:00:00','2024-03-30 00:00:00'],
[58,1,'Miso','Hikari Miso Japan',"'White shiro miso paste, fermented soybean'",500,113.08,'g','Asian Ingredients',1,'admin','admin','2024-01-20 00:00:00','2024-02-25 00:00:00'],
[59,1,'Mixed Fruits','Del Monte PH','Canned mixed tropical fruit cocktail in syrup',500,162.41,'g','Canned Goods',0,'admin','admin','2024-02-13 00:00:00','2024-02-23 00:00:00'],
[60,1,'Mushroom','Sagada Fresh Farms',"'Button mushrooms, fresh-sliced or whole'",500,413.61,'g','Vegetables',0,'admin','admin','2024-02-11 00:00:00','2024-04-22 00:00:00'],
[61,1,'Mustard','French\'s USA',"'Yellow prepared mustard, classic style'",10,1.46,'g','Sauces & Condiments',0,'admin','admin','2024-02-01 00:00:00','2024-02-03 00:00:00'],
[62,1,'Noodles','Lucky Me PH','Thick wheat egg noodles for stir-fry and soups',10,9.34,'g','Dry Goods',1,'admin','admin','2024-02-11 00:00:00','2024-03-13 00:00:00'],
[63,1,'Nori','Yamamoto Seaweed',"'Roasted nori seaweed sheets, premium grade'",20,9.32,'pcs','Asian Ingredients',0,'admin','admin','2024-01-30 00:00:00','2024-02-27 00:00:00'],
[64,1,'Oil','Baguio Gold',"'Refined coconut cooking oil, food-grade'",200,182.44,'ml','Oils & Fats',0,'admin','admin','2024-01-20 00:00:00','2024-03-09 00:00:00'],
[65,1,'Onion','NovaliCrop Farms',"'White onions, peeled and diced'",5,4.93,'g','Vegetables',0,'admin','admin','2024-01-23 00:00:00','2024-03-22 00:00:00'],
[66,1,'Oreo','Nabisco/Mondelez',"'Classic Oreo sandwich cookies, crushed for desserts'",50,24.04,'g','Confectionery',1,'admin','admin','2024-02-14 00:00:00','2024-04-26 00:00:00'],
[67,1,'Parmesan','Grana Padano Italy',"'Aged Parmigiano-Reggiano, finely grated'",500,119.66,'g','Dairy',1,'admin','admin','2024-01-24 00:00:00','2024-02-21 00:00:00'],
[68,1,'Pasta','Barilla Italy',"'Durum wheat semolina pasta, various cuts'",5,3.11,'g','Dry Goods',1,'admin','admin','2024-02-01 00:00:00','2024-02-09 00:00:00'],
[69,1,'Pasta Sheets','Barilla Italy',"'Flat lasagna pasta sheets, no pre-boil required'",100,15.14,'g','Dry Goods',1,'admin','admin','2024-02-02 00:00:00','2024-04-04 00:00:00'],
[70,1,'Peanut Sauce','Jufran PH','Creamy Filipino-style peanut satay sauce',20,3.02,'g','Sauces & Condiments',1,'admin','admin','2024-01-31 00:00:00','2024-02-11 00:00:00'],
[71,1,'Penne','Barilla Italy','Classic ridged penne rigate pasta',20,3.23,'g','Dry Goods',1,'admin','admin','2024-01-17 00:00:00','2024-04-13 00:00:00'],
[72,1,'Pesto','Barilla Italy','Basil pesto with pine nuts and Parmesan',25,11.58,'g','Sauces & Condiments',0,'admin','admin','2024-02-14 00:00:00','2024-04-27 00:00:00'],
[73,1,'Pesto Sauce','Barilla Italy','Ready-to-use traditional Genovese basil pesto',25,15.53,'g','Sauces & Condiments',0,'admin','admin','2024-01-16 00:00:00','2024-04-05 00:00:00'],
[74,1,'Pork','Prime Cut Meats',"'Premium pork loin or shoulder cuts, chilled'",10,4.77,'g','Pork Products',0,'admin','admin','2024-02-02 00:00:00','2024-04-15 00:00:00'],
[75,1,'Pork Belly','Prime Cut Meats',"'Skin-on pork belly slab, chilled'",100,94.12,'g','Pork Products',0,'admin','admin','2024-01-21 00:00:00','2024-04-16 00:00:00'],
[76,1,'Pork Broth','Knorr Philippines','Rich slow-simmered pork bone broth concentrate',100,31.48,'ml','Stocks & Broths',0,'admin','admin','2024-01-27 00:00:00','2024-02-13 00:00:00'],
[77,1,'Pork Filling','Prime Cut Meats','Seasoned ground pork filling for dumplings and buns',50,25.58,'g','Pork Products',0,'admin','admin','2024-02-13 00:00:00','2024-02-23 00:00:00'],
[78,1,'Potato','Benguet Fresh Farms',"'Locally grown Benguet potatoes, washed'",5,2.56,'g','Vegetables',0,'admin','admin','2024-02-02 00:00:00','2024-02-15 00:00:00'],
[79,1,'Rice','NFA/Dimasalang Rice',"'Premium long-grain white rice, 5% brokens'",10,5.84,'g','Grains & Starches',0,'admin','admin','2024-01-31 00:00:00','2024-03-05 00:00:00'],
[80,1,'Salt','Asin Tibuok Heritage',"'Fine sea salt, iodized and food-grade'",20,18.8,'g','Spices & Seasonings',0,'admin','admin','2024-02-12 00:00:00','2024-02-21 00:00:00'],
[81,1,'Sauce','UFC Philippines',"'Versatile cooking sauce, sweet-savory blend'",25,10.81,'ml','Sauces & Condiments',0,'admin','admin','2024-01-20 00:00:00','2024-03-17 00:00:00'],
[82,1,'Seafood','SeaHarvest PH',"'Assorted mixed seafood (squid, shrimp, clams)'",50,32.53,'g','Seafood',1,'admin','admin','2024-02-09 00:00:00','2024-05-03 00:00:00'],
[83,1,'Seafood Mix','SeaHarvest PH','IQF frozen seafood medley blend',5,3.51,'g','Frozen Goods',1,'admin','admin','2024-02-01 00:00:00','2024-03-11 00:00:00'],
[84,1,'Sesame','Kadoya Japan',"'Toasted sesame seeds, white and black blend'",10,9.45,'g','Spices & Seasonings',0,'admin','admin','2024-01-19 00:00:00','2024-02-22 00:00:00'],
[85,1,'Shrimp','SeaHarvest PH',"'Fresh peeled and deveined shrimp, medium size'",10,9.01,'g','Seafood',1,'admin','admin','2024-02-07 00:00:00','2024-04-18 00:00:00'],
[86,1,'Soda','Coca-Cola PH',"'Assorted carbonated soft drinks, 1.5L PET'",20,6.9,'ml','Beverages',0,'admin','admin','2024-02-03 00:00:00','2024-03-01 00:00:00'],
[87,1,'Soy Sauce','Datu Puti PH','Silver Swan-style naturally brewed soy sauce',100,28.32,'ml','Sauces & Condiments',1,'admin','admin','2024-02-04 00:00:00','2024-03-09 00:00:00'],
[88,1,'Spices','La Pacita Spices','House-blend aromatic spice mix for marination',500,163.0,'g','Spices & Seasonings',0,'admin','admin','2024-02-13 00:00:00','2024-02-20 00:00:00'],
[89,1,'Strawberries','Baguio Fresh Farms',"'Fresh Baguio strawberries, hulled and washed'",10,6.71,'g','Fresh Fruits',0,'admin','admin','2024-02-10 00:00:00','2024-03-17 00:00:00'],
[90,1,'Sugar','San Carlos Milling',"'Refined white cane sugar, food-grade'",5,0.52,'g','Sweeteners',0,'admin','admin','2024-02-08 00:00:00','2024-02-25 00:00:00'],
[91,1,'Syrup','Monin France',"'Premium flavored syrups (vanilla, caramel, chocolate)'",50,12.27,'ml','Sweeteners',0,'admin','admin','2024-01-29 00:00:00','2024-04-09 00:00:00'],
[92,1,'Tamarind','NovaliCrop Farms',"'Fresh tamarind pods, pulp-extracted'",200,120.96,'g','Local Ingredients',0,'admin','admin','2024-01-18 00:00:00','2024-01-28 00:00:00'],
[93,1,'Tamarind Mix','Knorr Philippines','Sinigang mix concentrate from tamarind base',20,11.82,'g','Local Ingredients',0,'admin','admin','2024-02-10 00:00:00','2024-03-29 00:00:00'],
[94,1,'Teriyaki Sauce','Kikkoman Japan','Authentic Japanese teriyaki glaze sauce',20,9.74,'ml','Asian Ingredients',0,'admin','admin','2024-01-16 00:00:00','2024-02-25 00:00:00'],
[95,1,'Tofu','Soylandia PH',"'Firm silken tofu, locally produced and chilled'",100,90.91,'g','Plant-Based',0,'admin','admin','2024-02-09 00:00:00','2024-02-15 00:00:00'],
[96,1,'Tomato Sauce','Del Monte PH','Tomato sauce with Italian herbs blend',100,28.91,'g','Canned Goods',0,'admin','admin','2024-01-22 00:00:00','2024-04-17 00:00:00'],
[97,1,'Tortilla','Mission Foods',"'Flour tortilla wraps, 10-inch diameter'",10,4.18,'pcs','Bakery',0,'admin','admin','2024-02-01 00:00:00','2024-03-25 00:00:00'],
[98,1,'Tuna','Century Tuna PH',"'Skipjack tuna loins, chilled or canned in brine'",20,18.66,'g','Seafood',1,'admin','admin','2024-01-22 00:00:00','2024-02-12 00:00:00'],
[99,1,'Ube','Kapuso Brand',"'Purple yam (ube) halaya paste, sweetened'",20,17.87,'g','Local Ingredients',0,'admin','admin','2024-01-15 00:00:00','2024-02-07 00:00:00'],
[100,1,'Unagi','Yamasa Japan',"'Grilled freshwater eel with kabayaki glaze, frozen'",100,80.41,'g','Seafood',1,'admin','admin','2024-01-28 00:00:00','2024-04-23 00:00:00'],
[101,1,'Vegetables','Benguet Fresh Farms',"'Seasonal mixed vegetables, freshly harvested'",25,8.5,'g','Vegetables',0,'admin','admin','2024-02-09 00:00:00','2024-05-09 00:00:00'],
[102,1,'Vinegar','Datu Puti PH',"'Sugarcane or coconut vinegar, naturally fermented'",10,4.44,'ml','Sauces & Condiments',0,'admin','admin','2024-01-16 00:00:00','2024-03-17 00:00:00'],
[103,1,'Wrapper','Wing Yip Asia',"'Spring roll wrappers, thin and crispy type'",25,6.99,'pcs','Asian Ingredients',1,'admin','admin','2024-02-13 00:00:00','2024-04-12 00:00:00'],
[104,1,'Yakiniku Sauce','Ebara Foods Japan','Japanese BBQ yakiniku tare dipping sauce',100,37.47,'ml','Asian Ingredients',0,'admin','admin','2024-02-09 00:00:00','2024-03-10 00:00:00']
    );


    public function run()
    {
        $records = array();
        //$this->db->table('ingredient')->truncate();
        $this->db->table('ingredient')->where('1=1')->delete();
        for ($x = 0; $x < count($this->data); $x++) {
            $ingredient = $this->data[$x];
            $record = [
                'ingredient_id' => $ingredient[0],
                'brand_id' => $ingredient[1],
                'name' => $ingredient[2],
                'brand' => $ingredient[3],
                'description' => $ingredient[4],
                'qty_purchased' => $ingredient[5],
                'qty_remaining' => $ingredient[6],
                'unit_of_measure' => $ingredient[7],
                'category' => $ingredient[8],
                'allergen_flag' => $ingredient[9],
                'created_by' => $ingredient[10],
                'updated_by' => $ingredient[11],
            ];
            $records[] = $record;
        }
        $this->db->table('ingredient')->insertBatch($records);
    }
}
