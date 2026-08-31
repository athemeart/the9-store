import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
import test from 'node:test';

const read = (path) => readFile(new URL(`../${path}`, import.meta.url), 'utf8');

test('archive description callback is registered once', async () => {
  const source = await read('inc/woocommerce.php');
  const registrations = source.match(/add_action\(\s*'the9_store_archive_description'/g) ?? [];

  assert.equal(registrations.length, 1);
});

test('bundled Bootstrap version matches registered version', async () => {
  const source = await read('inc/theme-core.php');

  assert.match(source, /bootstrap\.css' \), array\(\), '5\.3\.3'/);
  assert.match(source, /bootstrap\.js' \), array\(\), '5\.3\.3'/);
});

test('mobile navigation exposes its state to assistive technology', async () => {
  const markup = await read('inc/class/class-header.php');
  const behavior = await read('assets/js/the9-store.js');

  assert.match(markup, /aria-controls="aside-nav-wrapper"/);
  assert.match(markup, /aria-expanded="false"/);
  assert.match(behavior, /attr\('aria-expanded', menuIsOpen \? 'true' : 'false'\)/);
});

test('variation stock script contains translated labels, not PHP-like JavaScript', async () => {
  const source = await read('woocommerce/single-product/price.php');

  assert.match(source, /wp_json_encode\( esc_html__\( 'In Stock'/);
  assert.doesNotMatch(source, /\.esc_html__\(/);
});

test('WooCommerce overrides declare the versions shipped by WooCommerce 10.9.4', async () => {
  const expectedVersions = new Map([
    ['woocommerce/content-product.php', '9.4.0'],
    ['woocommerce/content-widget-product.php', '3.5.5'],
    ['woocommerce/loop/add-to-cart.php', '9.2.0'],
    ['woocommerce/loop/price.php', '1.6.4'],
    ['woocommerce/single-product/add-to-cart/external.php', '7.0.1'],
    ['woocommerce/single-product/add-to-cart/simple.php', '10.2.0'],
    ['woocommerce/single-product/add-to-cart/variation-add-to-cart-button.php', '10.5.2'],
    ['woocommerce/single-product/meta.php', '9.7.0'],
    ['woocommerce/single-product/price.php', '3.0.0'],
    ['woocommerce/single-product/rating.php', '3.6.0'],
    ['woocommerce/single-product/tabs/tabs.php', '9.8.0'],
    ['woocommerce/single-product/title.php', '1.6.4'],
  ]);

  for (const [path, version] of expectedVersions) {
    assert.match(await read(path), new RegExp(`@version\\s+${version.replaceAll('.', '\\.')}`), path);
  }
});

test('product rating uses the theme allowlist helper that actually exists', async () => {
  const source = await read('woocommerce/single-product/rating.php');

  assert.match(source, /the9_store_alowed_tags\(\)/);
  assert.doesNotMatch(source, /the9_store_allowed_tags\(\)/);
});

test('products-per-page only accepts the choices exposed by the toolbar', async () => {
  const source = await read('inc/woocommerce.php');
  const toolbar = await read('woocommerce/result-count.php');

  assert.match(source, /function the9_store_products_per_page_choice\(\)/);
  assert.match(source, /in_array\( \$requested, \$allowed, true \)/);
  assert.match(source, /'all' === \$posts_per_page \? -1/);
  assert.match(toolbar, /the9_store_products_per_page_choice\(\)/);
  assert.doesNotMatch(source, /shopstore_woo_shop_posts_per_page/);
});

test('page-specific scripts are not loaded globally', async () => {
  const globalAssets = await read('inc/theme-core.php');
  const commerceAssets = await read('inc/woocommerce.php');

  assert.doesNotMatch(globalAssets, /wp_enqueue_script\( 'sticky-sidebar'/);
  assert.doesNotMatch(globalAssets, /wp_enqueue_script\( 'customselect'/);
  assert.match(globalAssets, /if \( is_singular\(\) && has_post_thumbnail\(\) \)/);
  assert.match(commerceAssets, /if \( is_woocommerce\(\) \)/);
  assert.match(commerceAssets, /array\( 'jquery', 'customselect' \)/);
});

test('theme owns footer data without hard-coded store facts', async () => {
  const data = await read('inc/shams-store-data.php');
  const footer = await read('inc/class/class-footer.php');

  assert.match(data, /get_option\( 'shams_global_shell_options', array\(\) \)/);
  assert.match(data, /set_theme_mod\( \$theme_key, \$value \)/);
  assert.doesNotMatch(data, /Sherif Street|Omar Ibn|022390|010233/);
  assert.match(footer, /the9_store_footer_branches\(\)/);
  assert.match(footer, /has_nav_menu\( 'footer-shop' \)/);
  assert.match(footer, /has_nav_menu\( 'footer-information' \)/);
});

test('header and footer render only assigned WordPress menus', async () => {
  const setup = await read('inc/theme-core.php');
  const header = await read('inc/class/class-header.php');

  assert.match(setup, /'footer-shop'/);
  assert.match(setup, /'footer-information'/);
  assert.doesNotMatch(header, /fallback_2/);
  assert.match(header, /'fallback_cb'\s*=> false/);
});

test('custom fork does not register the upstream Pro upsell', async () => {
  const customizer = await read('inc/customizer/customizer.php');
  const bootstrap = await read('functions.php');

  assert.doesNotMatch(customizer, /Upgrade to The9 Store Pro|Go PRO/);
  assert.doesNotMatch(bootstrap, /inc\/about-themes\.php/);
});

test('header commerce tools use live WooCommerce data and accessible controls', async () => {
  const header = await read('inc/class/class-header.php');

  assert.match(header, /get_product_search_form\(\)/);
  assert.match(header, /private function product_category_navigation\(\)/);
  assert.match(header, /'taxonomy'\s*=>\s*'product_cat'/);
  assert.match(header, /get_term_link\( \$category \)/);
  assert.match(header, /the9-store-account-link/);
  assert.match(header, /aria-label=/);
});

test('structured footer is the only footer content source', async () => {
  const footer = await read('inc/class/class-footer.php');

  assert.doesNotMatch(footer, /dynamic_sidebar\(\s*'footer-1'/);
  assert.match(footer, /esc_attr__\( 'Social media', 'the9-store' \)/);
  assert.match(footer, /noopener noreferrer/);
  assert.match(footer, /'menu_class'\s*=>\s*'the9-store-footer-menu'/);
  assert.match(footer, /the9-store-footer-branches/);
});

test('Shams design layer loads after theme and WooCommerce styles', async () => {
  const assets = await read('inc/theme-core.php');

  assert.match(assets, /function the9_store_shams_styles\(\)/);
  assert.match(assets, /wp_style_is\( 'the9-store-woocommerce-style', 'enqueued' \)/);
  assert.match(assets, /add_action\( 'wp_enqueue_scripts', 'the9_store_shams_styles', 30 \)/);
});

test('shared design layer is tokenized, responsive, RTL-safe and motion-safe', async () => {
  const styles = await read('assets/css/shams-store.css');

  assert.match(styles, /--shams-accent:/);
  assert.match(styles, /margin-inline:/);
  assert.match(styles, /inset-inline:/);
  assert.match(styles, /@media \(max-width: 767px\)/);
  assert.match(styles, /@media \(prefers-reduced-motion: reduce\)/);
  assert.doesNotMatch(styles, /Sherif Street|Omar Ibn|022390|010233/);
  assert.match(styles, /#navbar\.the9-store-navbar/);
  assert.doesNotMatch(styles, /\.navbar-area/);
  assert.match(styles, /#masthead\.the9-store-site-header \.header-icon > li > \.the9-store-account-link/);
  assert.match(styles, /\.the9-store-footer-brand \.custom-logo/);
});

test('sanitized footer accessibility attributes survive the theme allowlist', async () => {
  const allowlist = await read('inc/template-functions.php');
  const iconDefinitions = allowlist.match(/'i'\s*=>\s*array\(/g) ?? [];

  assert.equal(iconDefinitions.length, 1);
  assert.match(allowlist, /'i'\s*=>\s*array\([\s\S]*?'aria-hidden'\s*=>\s*array\(\)/);
  assert.match(allowlist, /'ul'\s*=>\s*array\([\s\S]*?'aria-label'\s*=>\s*array\(\)/);
});
