# Zncr Default Product Attribute Combination

This prestashop module loops for product attribute combinations and looks for those which aren't available (stock available == 0). When product attribute found then module changes default product attribute combination to first cheapest available. Module works in background so you need to have access to cron.

## Install
1. Download zip
2. Upload zip content to your server via FTP
3. Find and install Zncr Default Product Attribute Combination module in your prestashop backoffice
4. Add cron on your hosting administration panel `* */6 * * * wget -qO- YOUR_SHOP_BASE_URL/module/zncr_defaultproductattributecombination/cron &> /dev/null`