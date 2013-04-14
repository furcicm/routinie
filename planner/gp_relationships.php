<?php
  require_once("gen_plan_inc.php");
?>
<script>
  $('.general-menu-item').removeClass('menu-item-selected');
  $('.menu-item-relationships').addClass('menu-item-selected');
</script>

<div class="planner-relationships-container">
  
  <!-- Question nr. 1 -->
  <div class="category-question">
    <div class="planner-question-title">Time with spouse</div>
    <div class="planner-question-text">Time spent with your spouse</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
        <select name="select-now" class="category-select answer-now">
          <option value="1">No spouse</option>
          <option value="2">&lt;1 hr</option>
          <option value="3">1-2 hrs</option>
          <option value="4">More</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
        <select name="select-now" class="category-select answer-after">
          <option value="1">No spouse</option>
          <option value="2">&lt;1 hr</option>
          <option value="3">1-2 hrs</option>
          <option value="4">More</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 2 -->
  <div class="category-question">
    <div class="planner-question-title">Time with children</div>
    <div class="planner-question-text">Time spent with your kids</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
        <select name="select-now" class="category-select answer-now">
          <option value="1">No kids</option>
          <option value="2">&lt;1 hr</option>
          <option value="3">1-2 hrs</option>
          <option value="4">More</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
        <select name="select-now" class="category-select answer-after">
          <option value="1">No kids</option>
          <option value="2">&lt;1 hr</option>
          <option value="3">1-2 hrs</option>
          <option value="4">More</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 3 -->
  <div class="category-question">
    <div class="planner-question-title">Work in weekend</div>
    <div class="planner-question-text">How many time do you work in weekend?</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
        <select name="select-now" class="category-select answer-now">
          <option value="1">No</option>
          <option value="2">&lt;2 hr</option>
          <option value="3">3-5 hrs</option>
          <option value="4">More</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
        <select name="select-now" class="category-select answer-after">
          <option value="1">No</option>
          <option value="2">&lt;2 hr</option>
          <option value="3">3-5 hrs</option>
          <option value="4">More</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 4 -->
  <div class="category-question">
    <div class="planner-question-title">Very good friends</div>
    <div class="planner-question-text">How many good friends do you have?</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
          <select name="select-now" class="category-select answer-now">
            <option value="1">No</option>
            <option value="2">1-2</option>
            <option value="3">3-5</option>
            <option value="4">More</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
          <select name="select-after" class="category-select answer-after">
            <option value="1">No</option>
            <option value="2">1-2</option>
            <option value="3">3-5</option>
            <option value="4">More</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 5 -->
  <div class="category-question">
    <div class="planner-question-title">Promises kept</div>
    <div class="planner-question-text">Do you keep your promises?</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
          <select name="select-now" class="category-select answer-now">
            <option value="1">&lt;25&#37;</option>
            <option value="2">&#126;50&#37;</option>
            <option value="3">&lt;75&#37;</option>
            <option value="4">All</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
          <select name="select-after" class="category-select answer-after">
            <option value="1">&lt;25&#37;</option>
            <option value="2">&#126;50&#37;</option>
            <option value="3">&lt;75&#37;</option>
            <option value="4">All</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
</div> 

<a href="/?q=general-planner/hapiness"><div class="planner-next-step">Next Step</div></a>
