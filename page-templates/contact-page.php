<?php
/**
 * Template Name: Contact Page (Anti-Gravity)
 *
 * This template handles the contact form and vehicle inquiries.
 * It automatically detects 'contact' slug or can be assigned manually.
 */

get_header();

// Handle Form Submission
$msg_status = '';
if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ctr_contact_submit']) ) {

    // Sanitize Inputs
    $name = sanitize_text_field($_POST['ctr_name']);
    $email = sanitize_email($_POST['ctr_email']);
    $phone = sanitize_text_field($_POST['ctr_phone']);
    $message = sanitize_textarea_field($_POST['ctr_message']);

    // Vehicle Details
    $brand = sanitize_text_field($_POST['ctr_brand']);
    $model = sanitize_text_field($_POST['ctr_model']);
    $engine = sanitize_text_field($_POST['ctr_engine']);
    $stage = sanitize_text_field($_POST['ctr_stage']);

    // Build Email
    $to = get_option('admin_email');
    $subject = "New Tuning Inquiry from $name";

    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n\n";

    if($brand) {
        $body .= "--- VEHICLE DETAILS ---\n";
        $body .= "Vehicle: $brand $model\n";
        $body .= "Engine: $engine\n";
        $body .= "Stage: $stage\n";
        $body .= "-----------------------\n\n";
    }

    $body .= "Message:\n$message\n";

    $headers = array('Content-Type: text/plain; charset=UTF-8');
    $headers[] = 'From: ' . get_bloginfo('name') . ' <' . $to . '>';
    $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';

    // Send
    if ( wp_mail( $to, $subject, $body, $headers ) ) {
        $msg_status = 'success';
    } else {
        $msg_status = 'error';
    }
}

// Get URL Parameters for Pre-filling
$req_brand = isset($_GET['brand']) ? sanitize_text_field($_GET['brand']) : '';
$req_model = isset($_GET['model']) ? sanitize_text_field($_GET['model']) : '';
$req_engine = isset($_GET['engine']) ? sanitize_text_field($_GET['engine']) : '';
$req_stage = isset($_GET['stage']) ? sanitize_text_field($_GET['stage']) : '';

?>

<style>
    .ctr-contact-wrapper {
        max-width: 800px;
        margin: 120px auto 60px;
        padding: 40px;
        background: #0b0f19;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 16px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        position: relative;
        overflow: hidden;
    }

    /* Neon Glow */
    .ctr-contact-wrapper::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #ccff00, transparent);
    }

    .ctr-contact-title {
        font-family: 'Orbitron', sans-serif;
        font-size: 36px;
        font-weight: 900;
        text-align: center;
        color: white;
        margin-bottom: 10px;
        text-transform: uppercase;
        font-style: italic;
    }

    .ctr-contact-subtitle {
        text-align: center;
        color: #888;
        margin-bottom: 40px;
    }

    /* Vehicle Summary Card */
    .ctr-vehicle-summary {
        background: rgba(204, 255, 0, 0.05);
        border: 1px solid rgba(204, 255, 0, 0.2);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .ctr-vs-icon {
        font-size: 24px;
        color: #ccff00;
    }

    .ctr-vs-text {
        color: white;
        font-size: 14px;
    }

    .ctr-vs-highlight {
        color: #ccff00;
        font-weight: bold;
        text-transform: uppercase;
    }

    /* Form Styles */
    .ctr-form-group {
        margin-bottom: 20px;
    }

    .ctr-label {
        display: block;
        color: #aaa;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .ctr-input, .ctr-textarea {
        width: 100%;
        background: #111;
        border: 1px solid #333;
        color: white;
        padding: 15px;
        border-radius: 6px;
        font-family: sans-serif;
        transition: all 0.3s;
    }

    .ctr-input:focus, .ctr-textarea:focus {
        outline: none;
        border-color: #ccff00;
        box-shadow: 0 0 15px rgba(204, 255, 0, 0.1);
        background: #161616;
    }

    .ctr-textarea {
        height: 150px;
        resize: vertical;
    }

    .ctr-submit-btn {
        width: 100%;
        padding: 18px;
        background: #ccff00;
        color: black;
        font-weight: 900;
        text-transform: uppercase;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        letter-spacing: 1px;
        transition: all 0.3s;
        font-style: italic;
    }

    .ctr-submit-btn:hover {
        background: white;
        box-shadow: 0 0 30px rgba(204, 255, 0, 0.4);
        transform: translateY(-2px);
    }

    /* Alerts */
    .ctr-alert {
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 30px;
        text-align: center;
        font-weight: bold;
    }
    .ctr-alert-success { background: rgba(0, 255, 102, 0.1); color: #00ff66; border: 1px solid #00ff66; }
    .ctr-alert-error { background: rgba(255, 0, 0, 0.1); color: #ff3333; border: 1px solid #ff3333; }

</style>

<div class="ctr-contact-wrapper">

    <?php $contact_hook = tm_get_dynamic_title('contact'); ?>
    <h1 class="ctr-contact-title"><?php echo $contact_hook['title']; ?></h1>
    <p class="ctr-contact-subtitle"><?php echo $contact_hook['subtitle']; ?></p>

    <?php if ($msg_status == 'success'): ?>
        <div class="ctr-alert ctr-alert-success">
            ✅ Message sent successfully! We will get back to you soon.
        </div>
    <?php elseif ($msg_status == 'error'): ?>
        <div class="ctr-alert ctr-alert-error">
            ❌ Failed to send message. Please try again later or email us directly.
        </div>
    <?php endif; ?>

    <!-- Vehicle Inquiry Summary -->
    <?php if($req_brand): ?>
        <div class="ctr-vehicle-summary">
            <div class="ctr-vs-icon">🚗</div>
            <div class="ctr-vs-text">
                Inquiry regarding: <br>
                <span class="ctr-vs-highlight"><?php echo esc_html("$req_brand $req_model"); ?></span>
                <?php if($req_engine) echo "- " . esc_html($req_engine); ?>
                <?php if($req_stage) echo " (" . esc_html($req_stage) . ")"; ?>
            </div>
        </div>
    <?php endif; ?>

    <form method="post" action="">

        <!-- Hidden Vehicle Data -->
        <input type="hidden" name="ctr_brand" value="<?php echo esc_attr($req_brand); ?>">
        <input type="hidden" name="ctr_model" value="<?php echo esc_attr($req_model); ?>">
        <input type="hidden" name="ctr_engine" value="<?php echo esc_attr($req_engine); ?>">
        <input type="hidden" name="ctr_stage" value="<?php echo esc_attr($req_stage); ?>">

        <div class="ctr-form-group">
            <label class="ctr-label">Your Name</label>
            <input type="text" name="ctr_name" class="ctr-input" required placeholder="John Doe">
        </div>

        <div class="ctr-form-group">
            <label class="ctr-label">Email Address</label>
            <input type="email" name="ctr_email" class="ctr-input" required placeholder="john@example.com">
        </div>

        <div class="ctr-form-group">
            <label class="ctr-label">Phone Number (Optional)</label>
            <input type="tel" name="ctr_phone" class="ctr-input" placeholder="+1 234 567 890">
        </div>

        <div class="ctr-form-group">
            <label class="ctr-label">Message</label>
            <textarea name="ctr_message" class="ctr-textarea" required placeholder="How can we help you?"></textarea>
        </div>

        <button type="submit" name="ctr_contact_submit" class="ctr-submit-btn">Send Message</button>

    </form>

</div>

<?php get_footer(); ?>
