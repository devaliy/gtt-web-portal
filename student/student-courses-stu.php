<?php
    $student_courses_stu = 'active';

?>
                <!-- Header Layout Content -->
                <div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">




                    <div class="page__heading border-bottom">
                        <div class="container-fluid page__container d-flex align-items-center">
                            <h1 class="mb-0">Courses</h1>
                        </div>
                    </div>
                   
                    <div class="container-fluid page__container">
                    <form  method="post" id="student_general_search_form" class="mb-3 border-bottom pb-3">
     
                    <div class="d-flex">
                            <div class="search-form mr-3 search-form--light">
                            <input type="text" name="student_general_search" class="form-control" placeholder="Search courses" id="student_general_search">
                                <input class="btn " name="submit_search" value="" type="submit"><i type="submit" id="search_g_btn" class="btn material-icons">search</i>
                            </div>
                                <div class="form-inline ml-auto">
                                    <div class="form-group mr-3">
                                        <label for="custom-select" class="form-label mr-1">Category</label>
                                        <select id="student_category_search" class="form-control custom-select" style="width: 200px;">
                                            <option selected>All categories</option>
                                            <?php

                                                $categories =  $getFromCourse->get_multi('course_category');

                                                foreach($categories as $cat):

                                                ?>

                                                <option value="<?=$cat->id?>"><?=$cat->cat_name;?></option>

                                                <?php endforeach;?>
                                        </select>
                                    </div>
                                  <!--  <div class="form-group">
                                        <label for="published01" class="form-label mr-1">Status</label>
                                        <select id="published01" class="form-control custom-select" style="width: 200px;">
                                            <option selected>All</option>
                                            <option value="1">In Progress</option>
                                            <option value="3">New Releases</option>
                                        </select>
                                    </div>-->
                                </div>
                            </div>
                        </form>

                        <div class="row">

                        <?php 

                            if(isset($_GET['student_courses'])){
                              
                                    $limit = 10;
                                   if($_GET['student_courses'] == 0){
                                        $page = 1;
                                    $offset = (($page - 1)* $limit );
                                   }else{
                                       $page = $_GET['student_courses'];
                                       $offset = (($page - 1)* $limit );
                                   }

                                   $cur =  $paginations =$getFromCourse->pagination_lower('courses', $offset, $limit);

                                   $lower = ($page - 1) * $limit + $cur;
                                   $uper = $getFromCourse->pagination_count('courses');


                                  
                                  
                                $paginations =$getFromCourse->pagination('courses', $offset, $limit);
                                   
                                foreach($paginations as $data):
                             
                        ?>


                            <div class="col-md-3">
                                <div class="card card__course">
                                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="student/subscribe/<?=$data->id;?>">
                                            <span><img src="<?=BASE_URL?>/admin/<?=$data->avatar;?>" class="mb-1" style="width:34px;" alt="logo"></span>
                                            <span class="course__title"><?=$data->course_abrev;?></span>
                                            <span class="course__subtitle"><?=$data->course_name;?></span>
                                        </a>
                                    </div>
                                    <div class="p-3">
                                        <div class="mb-2">
                                        <span class="mr-2">
                                          <?php 
                                                $get_rating_count = $getFromCourse->get_count_where('rating', 'course_id', $data->id);
                                                $get_sum_rating = $getFromCourse->get_sum_where('rating', 'rating', 'course_id', $data->id);
                                                @$total_rating = $get_sum_rating /  $get_rating_count;
                                               // $total_rating = 4.5;

                                                $go = 1;

                                                while($go <= @round($total_rating)){

                                             
                                            ?>
                                          
                                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                                                <?php  $go +=1;  }?>
                                        </span>
                                           
                                        <strong> <?php if($total_rating >=0){
                                                    echo $total_rating;
                                                }else{
                                                    echo 0;
                                                } ;?></strong>
                                                
                                                <br />
                                            <small class="text-muted">(<?=@$get_rating_count;?>  ratings)</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <strong class="h4 m-0">&#36; <?=number_format($data->price, 2);?></strong>
                                            <a href="student/subcribe/<?=$data->id;?>" class="btn btn-primary ml-auto"><i class="material-icons">add_shopping_cart</i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
  
                        <?php 
                         endforeach;
                             }
                         
                       
                        ?>

                           

                        </div>
                        <hr>
                     <div class="d-flex flex-row align-items-center mb-3">
                          <!--     <div class="form-inline">
                                View
                                <select class="custom-select ml-2">
                                    <option value="20" selected>20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                </select>
                            </div>-->
                            <div class="ml-auto">
                            <?php 
                                    if($page == 1){

                                 
                                ?>
                                 <?php }else{
                                        ?> 

                            <a href="admin/student_courses/<?=$page - 1?>" class=""><i class="material-icons float-left">arrow_backward</i></a>
                            <?php }?>
                              <?=$lower;?> <span class=" text-center text-black">of  <?=$uper;?></span>
                                
                              
                                 <?php 
                                    if($lower == $uper){

                                 
                                ?>
                                    <?php }else{
                                        ?> 
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a href="admin/student_courses/<?=$page + 1?>" class=""><i class="material-icons float-right">arrow_forward</i></a>
                                        <?php }?>
                            </div>
                        </div>

                    </div>


                </div>
                <!-- // END header-layout__content -->

          