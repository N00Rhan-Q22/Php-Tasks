<?php

namespace app\database\models;

use app\database\config\connection;

class Product extends connection
{
    private $id, $name_en, $name_ar, $price, $quantity, $status, $image,
        $desc_en, $desc_ar, $subcategory_id, $brand_id, $created_at, $updated_at;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name_en
     */
    public function getName_en()
    {
        return $this->name_en;
    }

    /**
     * Set the value of name_en
     *
     * @return  self
     */
    public function setName_en($name_en)
    {
        $this->name_en = $name_en;

        return $this;
    }

    /**
     * Get the value of name_ar
     */
    public function getName_ar()
    {
        return $this->name_ar;
    }

    /**
     * Set the value of name_ar
     *
     * @return  self
     */
    public function setName_ar($name_ar)
    {
        $this->name_ar = $name_ar;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of desc_en
     */
    public function getDesc_en()
    {
        return $this->desc_en;
    }

    /**
     * Set the value of desc_en
     *
     * @return  self
     */
    public function setDesc_en($desc_en)
    {
        $this->desc_en = $desc_en;

        return $this;
    }

    /**
     * Get the value of desc_ar
     */
    public function getDesc_ar()
    {
        return $this->desc_ar;
    }

    /**
     * Set the value of desc_ar
     *
     * @return  self
     */
    public function setDesc_ar($desc_ar)
    {
        $this->desc_ar = $desc_ar;

        return $this;
    }

    /**
     * Get the value of subcategory_id
     */
    public function getSubcategory_id()
    {
        return $this->subcategory_id;
    }

    /**
     * Set the value of subcategory_id
     *
     * @return  self
     */
    public function setSubcategory_id($subcategory_id)
    {
        $this->subcategory_id = $subcategory_id;

        return $this;
    }

    /**
     * Get the value of brand_id
     */
    public function getBrand_id()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     * @return  self
     */
    public function setBrand_id($brand_id)
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function all(string $condition = "WHERE `products`.`status` = 1", string $order = "ORDER BY `price`,`name_en`")
    {
        $query = "SELECT
                    `products`.*, `categories`.`name_en` AS `category_name_en`,`categories`.`id` AS `category_id`, `brands`.`name_en` AS `brand_name_en`,
                    `sub_categories`.`name_en` AS `subcategory_name_en`, COUNT(`reviews`.`user_id`) AS `reviews_count`,
                    ROUND(IF(AVG(`reviews`.`value`) IS NULL , 0 , AVG(`reviews`.`value`))) AS `reviews_avg`
                FROM  `products`
                LEFT JOIN `brands` ON `brands`.`id` = `products`.`brand_id`
                JOIN `sub_categories` ON `sub_categories`.`id` = `products`.`sub_category_id`
                JOIN `categories` ON `categories`.`id` = `sub_categories`.`category_id`
                LEFT JOIN `reviews` ON `products`.`id` = `reviews`.`product_id`
                $condition
                GROUP BY `products`.`id`
                $order ";
        return $this->runDQL($query);
    }

    public function find()
    {
        $query = "SELECT `id`,`name_en` FROM `brands` WHERE `id` = {$this->id}";
        return $this->runDQL($query);
    }

    public function getProductReviews()
    {
        $query = "SELECT `reviews`.*,
                    CONCAT(`users`.`first_name`, ' ', `users`.`last_name` ) AS `full_name`
                FROM `reviews`
                JOIN `users` ON `reviews`.`user_id` = `users`.`id`
                WHERE `reviews`.`product_id` = {$this->id}";
        return $this->runDQL($query);
    }
    public function getDataBySubcatId()
    {
        $query = "SELECT id ,img ,price,desc_en, name_en from products_details where status=$this->status 
        and subcategory_id =$this->subcategory_id order by price , name_en";
        return $this->runDQL($query);
    }
    public function getDataByCategoryId()
    {
        $query = "SELECT id ,img ,price,desc_en, name_en from products_details where status=$this->status
         and category_id =$this->category_id order by price , name_en";
        return $this->runDQL($query);
    }

    public function getDataByBrandId()
    {
        $query = "SELECT * FROM products_details where status=$this->status and
         brand_id =$this->brand_id order by price , name_en";
        return $this->runDQL($query);
    }


    public function mostRecentProducts()
    {
        // $query="select * from products where STATUS=$this->status order by created_at DESC";

        $query = "SELECT * FROM products where STATUS=$this->status order by created_at DESC limit 8";
        return $this->runDQL($query);
    }
    public function mostRatedProducts()
    {
        // avg(count) >  avg(review) ==>view
        $query = "SELECT * FROM `products-reviews` where status = $this->status order by
         reviews_count desc,reviews_average DESC limit 4";
        return $this->runDQL($query);
    }

}
