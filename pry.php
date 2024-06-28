<div class="container">
    <div class="left-block">
      <p>We guarantee</p>
      <h1>We guarantee a quick transition from your
      idea to an awesome result</h1>
    </div>
    <div class="right-block">
      <div class="small-block-top-left">
        <p>Маленький блок 358px на 226px</p>
      </div>
      <div class="small-block-top-right">
        <p>Маленький блок 358px на 226px</p>
      </div>
      <div class="small-block-bottom-left">
        <p>Маленький блок 358px на 226px</p>
      </div>
      <div class="small-block-bottom-right">
        <p>Маленький блок 358px на 226px</p>
      </div>
    </div>
  </div>




<div class="container-boost-business">
    <div class="left-block-business">
      <div class="button-container">
        <button class="btn" onclick="updateText('What is pryvus Studio?', 'We are a team of developers who are passionate about making great products. We are so good, we could make a website for your cat. And wed make it so good that your cat would actually want to use it. We know that great design and great code are essential for any successful product. That is why we focus on both')">Button 1</button>
        <button class="btn" onclick="updateText('By by', 'лвоардлывоалдыв')">Button 2</button>
        <button class="btn" onclick="updateText('Button 3 text', 'Button 3 text')">Button 3</button>
        <button class="btn" onclick="updateText('Button 4 text', 'Button 4 text')">Button 4</button>
      </div>
    </div>
    <div class="right-block-business">
      <div class="text-container">
        <h2 id="title-display">Заголовок</h2>
        <p id="text-display">Текст</p>
      </div>
    </div>
  </div>

  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }
  
  .container {
    max-width: 1120px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
  }
  
  .left-block {
    width: 338px;
    background-color: #f1f1f1;
    padding: 20px;
  }
  
  .left-block h1 {
      position: sticky;
      width: 746px;
      height: 192px;
      top: 1946px;
      left: 80px;
      font-family: 'Roboto';
      font-size: 52px;
      font-weight: 600;
      line-height: 64px;
      text-align: left;
  
  }
  
  .left-block p {
      font-family: 'Roboto';
      font-size: 18px;
      font-weight: 300;
      line-height: 22px;
      letter-spacing: 0.02em;
      text-align: left;
      color: #656565;
  }
  
  .right-block {
    width: 732px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 20px;
  }
  
  .small-block-top-left,
  .small-block-top-right,
  .small-block-bottom-right {
    width: 358px;
    height: 226px;
    background-color: #f1f1f1;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .small-block-bottom-left {
    visibility: hidden;
    width: 358px;
    height: 226px;
    background-color: #f1f1f1;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .container-boost-business {
    max-width: 1120px;
    margin: 0 auto;
    padding-top: 50px;
    display: flex;
  }
  
  .left-block-business {
    width: 50%;
    background-color: #f1f1f1;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .right-block-business {
    width: 50%;
    background-color: #e9e9e9;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  
  .button-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 20px;
  }
  
  .btn {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
  }
  
  .text-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
  }

  // function updateText(title, text) {
//     document.getElementById('title-display').textContent = title;
//     document.getElementById('text-display').textContent = text;
//   }