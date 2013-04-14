<?php
  require_once("gen_plan_inc.php");
?>
<script>
  $('.general-menu-item').removeClass('menu-item-selected');
  $('.menu-item-health').addClass('menu-item-selected');
</script>

<div class="planner-health-container">
  
  <!-- Helpful data -->
  <div class="category-question">
    <div class="planner-question-title">Helpful data</div>
    <div class="planner-question-text">This information will help us</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Current Age</div>
        <input type="text" class="planner-answer-input answer-now">
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">Gender</div>
        <select name="gender" class="category-select answer-after">
          <option value="female">Female</option>
          <option value="male">Male</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 1 -->
  <div class="category-question">
    <div class="planner-question-title">Weight</div>
    <div class="planner-question-text">Information about your weight</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Current weight</div>
        <input type="text" class="planner-answer-input answer-now">
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">Your weight in <span class="year"></span> years.</div>
        <input type="text" class="planner-answer-input answer-after">
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 2 -->
  <div class="category-question">
    <div class="planner-question-title">Exercise per week</div>
    <div class="planner-question-text">Information about your exercise</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Exercise per week now</div>
          <select name="select-now" class="category-select answer-now">
            <option value="1">No</option>
            <option value="2">1-2 hrs</option>
            <option value="3">3-5 hrs</option>
            <option value="4">More</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">Exercise per week after <span class="year"></span> years.</div>
          <select name="select-after" class="category-select answer-after">
            <option value="1">No</option>
            <option value="2">1-2 hrs</option>
            <option value="3">3-5 hrs</option>
            <option value="4">More</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 3 -->
  <div class="category-question">
    <div class="planner-question-title">Water</div>
    <div class="planner-question-text">How much water you drink in a day?</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
          <select name="select-now" class="category-select answer-now">
            <option value="1">No, Other liquids</option>
            <option value="2">&lt;0,5L</option>
            <option value="3">0,5L - 1,5L</option>
            <option value="4">More</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
          <select name="select-after" class="category-select answer-after">
            <option value="1">No, Other liquids</option>
            <option value="2">&lt;0,5L</option>
            <option value="3">0,5L - 1,5L</option>
            <option value="4">More</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 4 -->
  <div class="category-question">
    <div class="planner-question-title">Raw Vegetables (100g/portion)</div>
    <div class="planner-question-text">How many portions do you eat?</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
          <select name="select-now" class="category-select answer-now answer-now">
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
    <div class="planner-question-title">Eating Breakfest</div>
    <div class="planner-question-text">After how many hours do you eat your breakfest?</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
          <select name="select-now" class="category-select answer-now">
            <option value="1">1 hr</option>
            <option value="2">2 hrs</option>
            <option value="3">3-5 hrs</option>
            <option value="4">More</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
          <select name="select-after" class="category-select answer-after">
            <option value="1">1 hr</option>
            <option value="2">2 hrs</option>
            <option value="3">3-5 hrs</option>
            <option value="4">More</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
</div>

<a href="/?q=general-planner/relationships"><div class="planner-next-step" page="health">Next Step</div></a>
