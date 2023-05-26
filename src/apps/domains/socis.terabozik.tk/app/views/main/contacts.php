<!-- Контакты -->

<style>
    
    .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    h1 {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    
    textarea {
        height: 150px;
    }
    
    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
    }
    
    .btn:hover {
        background-color: #45a049;
    }
</style>

<div class="container">
    <h1>Контактная страница (temp)</h1>
    
    <form action="/submit" method="post">
        <div class="form-group">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="message">Сообщение:</label>
            <textarea id="message" name="message" required></textarea>
        </div>
        
        <div class="form-group">
            <input type="submit" value="Отправить" class="btn">
        </div>
    </form>
</div>