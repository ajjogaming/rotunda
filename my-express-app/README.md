#f4f4f4;">
    <div style="flex: 1; background-image: url('path/to/your/background-image.jpg'); background-size: cover; display: flex; align-items: center; justify-content: center; color: white; text-align: center;">
        <h2>Contact Us</h2>
        <p>We would love to hear from you! Please reach out with any questions or comments.</p>
    </div>
    <div style="flex: 1; padding: 20px;">
        <form action="mailto:alex@petran.sk" method="post" enctype="text/plain">
            <div style="margin-bottom: 15px;">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" required style="width: 100%; padding: 8px;"/>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required style="width: 100%; padding: 8px;"/>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required style="width: 100%; padding: 8px;"/>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="message">Message:</label>
                <textarea id="message" name="message" required style="width: 100%; padding: 8px;" rows="4"></textarea>
            </div>
            <button type="submit" style="padding: 10px 15px; background-color: #007BFF; color: white; border: none; cursor: pointer;">Send Message</button>
        </form>
    </div>
</section>
```

### Explanation:
1. **Section Structure**: The section is divided into two parts using a flexbox layout. The left side contains a background image and a message, while the right side contains the contact form.
2. **Background Image**: Replace `'path/to/your/background-image.jpg'` with the actual path to your desired background image.
3. **Form**: The form collects the user's first name, last name, email, and message. It uses the `mailto:` action to send the form data to `alex@petran.sk`. Note that using `mailto:` may open the user's email client to send the message, which might not be the best user experience.
4. **Styling**: Basic inline styles are applied for layout and aesthetics. You can further enhance the styles using CSS classes or external stylesheets.

### Integration:
Make sure to place this code snippet in the appropriate location within your `index.php` file, ideally after the existing sections to maintain a logical flow.