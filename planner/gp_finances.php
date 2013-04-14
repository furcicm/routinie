<?php
  require_once("gen_plan_inc.php");
?>
<script>
  $('.general-menu-item').removeClass('menu-item-selected');
  $('.menu-item-finances').addClass('menu-item-selected');
</script>

<div class="planner-finances-container">
  
  <!-- Question nr. 1 -->
  <div class="category-question">
    <div class="planner-question-title">Professional Level</div>
    <div class="planner-question-text">Professional Level</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
        <select name="select-now" class="category-select answer-now">
          <option value="1">Student</option>
          <option value="2">Unemployed</option>
          <option value="3">Employed</option>
          <option value="4">Freelancer</option>
          <option value="5">Entrepreneuer/Owner</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
        <select name="select-now" class="category-select  answer-after">
          <option value="1">Student</option>
          <option value="2">Unemployed</option>
          <option value="3">Employed</option>
          <option value="4">Freelancer</option>
          <option value="5">Entrepreneuer/Owner</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 2 -->
  <div class="category-question">
    <div class="planner-question-title">Monthly Income</div>
    <div class="planner-question-text">Monthly Income</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
        <input type="text" class="planner-answer-input answer-now">
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
        <input type="text" class="planner-answer-input  answer-after">
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 3 -->
  <div class="category-question">
    <div class="planner-question-title">Savings</div>
    <div class="planner-question-text">Savings</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
        <select name="select-now" class="category-select answer-now">
          <option value="1">No</option>
          <option value="2">Yes, but not much</option>
          <option value="3">Yes</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
        <select name="select-now" class="category-select  answer-after">
          <option value="1">No</option>
          <option value="2">Yes, but not much</option>
          <option value="3">Yes</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 4 -->
  <div class="category-question">
    <div class="planner-question-title">Financial Freedom</div>
    <div class="planner-question-text">Financial Freedom</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
          <select name="select-now" class="category-select answer-now">
            <option value="1">No savings</option>
            <option value="2">1-3 months</option>
            <option value="3">4-11 months</option>
            <option value="4">1-2 years</option>
            <option value="5">&gt;3 years</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
          <select name="select-after" class="category-select  answer-after">
            <option value="1">No savings</option>
            <option value="2">1-3 months</option>
            <option value="3">4-11 months</option>
            <option value="4">1-2 years</option>
            <option value="5">&gt;3 years</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 5 -->
  <div class="category-question">
    <div class="planner-question-title">Holiday Trips</div>
    <div class="planner-question-text">Holiday Trips</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
          <select name="select-now" class="category-select answer-now">
            <option value="1">No trips</option>
            <option value="2">1 Week</option>
            <option value="3">2 Weeks</option>
            <option value="4">More</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
          <select name="select-after" class="category-select answer-after">
            <option value="1">No trips</option>
            <option value="2">1 Week</option>
            <option value="3">2 Weeks</option>
            <option value="4">More</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
</div> 

<a href="/"><div class="planner-next-step save-plan">Save plan</div></a>