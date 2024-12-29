var page = require('webpage').create(), system = require('system'), address;

if (system.args.length === 1) {
    console.log('Usage: snap.js <some URL>');
    phantom.exit();
}

address = system.args[1];
image = system.args[2];

page.open(address, function () {
    page.render('/var/www/xlogs/snaps/' + image + '.png');
    phantom.exit();
});
