<section id="contact" style="display: flex; height: 400px; background-color: #f4f4f4;">
    <div style="flex: 1; background-image: url('path/to/your/dark-background-image.jpg'); background-size: cover; display: flex; align-items: center; justify-content: center; color: white; padding: 20px;">
        <h2>Contact Us</h2>
    </div>
    <div style="flex: 1; padding: 20px;">
        <form action="mailto:alex@petran.sk" method="post" enctype="text/plain">
            <div style="margin-bottom: 15px;">
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first-name" required style="width: 100%; padding: 8px;"/>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last-name" required style="width: 100%; padding: 8px;"/>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required style="width: 100%; padding: 8px;"/>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="message">Message:</label>
                <textarea id="message" name="message" required style="width: 100%; padding: 8px; height: 100px;"></textarea>
            </div>
            <button type="submit" style="padding: 10px 15px; background-color: #007BFF; color: white; border: none; cursor: pointer;">Send Message</button>
        </form>
    </div>
</section>