<?php
/**
 * Template Name: Selector Test Page
 */

get_header();
?>

<div style="background: #000; min-height: 100vh; padding: 40px 20px;">
    <div style="max-width: 1400px; margin: 0 auto;">
        <h1 style="color: #00ff66; text-align: center; font-size: 2.5rem; margin-bottom: 40px;">
            🔧 SELECTOR TEST PAGE
        </h1>

        <div style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 10px; margin-bottom: 30px;">
            <h2 style="color: #ccff00; margin-bottom: 15px;">Diagnostic Info:</h2>
            <pre style="color: #fff; font-family: monospace; font-size: 12px;">
<?php
echo "Theme: " . wp_get_theme()->get('Name') . "\n";
echo "is_admin(): " . (is_admin() ? 'TRUE' : 'FALSE') . "\n";
echo "Auth: " . (Ctr_Api_Connector::authenticate() ? 'TRUE' : 'FALSE') . "\n";
$data = Ctr_Api_Connector::fetch_all_data(false);
echo "Data: " . ($data ? strlen($data) . " chars" : 'NULL') . "\n";
?>
            </pre>
        </div>

        <div style="background: rgba(255,255,255,0.02); padding: 30px; border-radius: 15px;">
            <h2 style="color: #00ccff; margin-bottom: 20px;">Car Selector Widget:</h2>
            <?php echo do_shortcode('[ctr_show_selector type="cars"]'); ?>
        </div>
    </div>
</div>

<?php
get_footer();
?>
