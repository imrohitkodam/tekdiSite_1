<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 */
defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

/* Prepare jcfields into $item->jcfields[...] */
foreach ($item->jcfields as $jcfield) {
    $item->jcfields[$jcfield->name] = $jcfield;
}

$benefitsAtTekdiCards = $item->jcfields['benefits-at-tekdi-info']->rawvalue;
$benefitsAtTekdiCards = json_decode($benefitsAtTekdiCards);

/* Optional icon path */
$iconPath = isset($item->jcfields['benefits-at-tekdi-icon']) ? $item->jcfields['benefits-at-tekdi-icon']->rawvalue : null;
$iconPath = $iconPath ? json_decode($iconPath) : null;

/* Gradients for slices (1..6) */
$gradients = [
    1 => 'linear-gradient(90deg, #2E3191 -40.69%, #00D5EB 101.24%);',
    2 => 'linear-gradient(274.34deg, #2581C4 -19.83%, #2E3191 125.12%);',
    3 => 'linear-gradient(270deg, #123E5E -18.39%, #0868B2 72.65%);',
    4 => 'linear-gradient(90deg, #0868B2 0%, #1C468A 100%);',
    5 => 'linear-gradient(270deg, #0040B3 -65.91%, #2581C4 76.52%);',
    6 => 'linear-gradient(270deg, #123E5E -83.17%, #29AAE1 96.64%)',
];
?>
<div class="benefits-wrapper">
    <ul class="circle" id="benefitsCircle" role="list">
        <?php
        $subformFieldId = 0;
        foreach ($benefitsAtTekdiCards as $benefitscard):
            $subformFieldId++;
            $gradient = isset($gradients[$subformFieldId]) ? $gradients[$subformFieldId] : $gradients[1];
            $dataBg = htmlspecialchars($gradient, ENT_QUOTES);
            ?>
            <li class="benefit-card benefit-<?php echo $subformFieldId; ?>" id="benefit-<?php echo $subformFieldId; ?>"
                data-bg="<?php echo $dataBg; ?>">
                <!-- wedge background -->
                <div class="text" style="background: <?php echo $dataBg; ?>;"></div>

                <a class="benefit-link" href="#" tabindex="0"
                    aria-describedby="benefit-info-<?php echo $subformFieldId; ?>">
                    <span class="title"><?php echo htmlspecialchars($benefitscard->field16); ?></span>
                    <span class="icon-img" aria-hidden="true">
                        <img src="<?php echo htmlspecialchars($benefitscard->field17->imagefile); ?>" alt="">
                    </span>
                </a>

                <!-- hidden full-circle content -->
                <div class="benefit-info" id="benefit-info-<?php echo $subformFieldId; ?>">
                    <h3><?php echo htmlspecialchars($benefitscard->field16); ?></h3>
                    <div class="details">
                        <div class="left-icon">
                            <div class="icon">
                                <img src="<?php echo htmlspecialchars($benefitscard->field17->imagefile); ?>" alt="">
                            </div>
                        </div>
                        <div class="desc">
                            <?php echo $benefitscard->field18; ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- center-hub removed -->

    <div class="benefit-overlay" aria-hidden="true"></div>
</div>

<style>
    .benefits-wrapper {
        position: relative;
        width: 420px;
        height: 420px;
        margin: 30px auto;
        border-radius: 100%;
        overflow: hidden;
    }

    .circle {
        list-style: none;
        padding: 0;
        margin: 0;
        width: 420px;
        height: 420px;
        border-radius: 50%;
        position: relative;
    }

    .circle li.benefit-card {
        overflow: hidden;
        position: absolute;
        top: 0px;
        right: 0;
        width: 50%;
        height: 50%;
        transform-origin: 0% 100%;
        border: 3px solid #fff;
    }

    .circle li.benefit-card .text {
        position: absolute;
        left: 0;
        top: 0;
        width: 200%;
        height: 200%;
        transform-origin: 0 0;
        pointer-events: none;
    }

    .circle li.benefit-card a {
        position: absolute;
        left: 0;
        top: 0;
        width: 200%;
        height: 200%;
        display: block;
        text-decoration: none;
    }

    .circle li.benefit-card a .title {
        position: absolute;
        color: #fff;
        font-weight: 600;
        font-size: 16px;
        line-height: 22px;
        width: 160px;
        text-align: left;
    }


    .circle li.benefit-card:nth-child(1) {
        transform: rotate(0deg) skewY(-30deg);
    }

    .circle li.benefit-card:nth-child(2) {
        transform: rotate(60deg) skewY(-30deg)
    }

    .circle li.benefit-card:nth-child(3) {
        transform: rotate(120deg) skewY(-30deg)
    }

    .circle li.benefit-card:nth-child(4) {
        transform: rotate(180deg) skewY(-30deg)
    }

    .circle li.benefit-card:nth-child(5) {
        transform: rotate(240deg) skewY(-30deg);
    }

    .circle li.benefit-card:nth-child(6) {
        transform: rotate(300deg) skewY(-30deg);
    }

    .benefits-wrapper .circle .benefit-1 .benefit-info {
        background: #1362BC !important;
    }

    .benefits-wrapper .circle .benefit-2 .benefit-info {
        background: #2580C4 !important;
    }

    .benefits-wrapper .circle .benefit-3 .benefit-info {
        background: #1A498E !important;
    }

    .benefits-wrapper .circle .benefit-4 .benefit-info {
        background: #0E4C7A !important;
    }

    .benefits-wrapper .circle .benefit-5 .benefit-info {
        background: #2B4CA2 !important;
    }

    .benefits-wrapper .circle .benefit-6 .benefit-info {
        background: #0080B9 !important;
    }

    /* rotate back text */
    .circle li.benefit-card:nth-child(1) a .title {
        transform: skewY(30deg) rotate(0deg);
        left: 40px;
        top: 90px;
        width: 120px;
        left: 10px;
        top: 105px;
    }

    .circle li.benefit-card:nth-child(2) a .title {
        transform: skewY(30deg) rotate(-60deg);
        width: 105px;
        left: 30px;
        top: 85px;
    }

    .circle li.benefit-card:nth-child(3) a .title {
        transform: skewY(30deg) rotate(-120deg);
        width: 105px;
        left: 10px;
        top: 80px;
    }

    .circle li.benefit-card:nth-child(4) a .title {
        transform: skewY(30deg) rotate(-180deg);
        width: 105px;
        left: 10px;
        top: 90px;
    }

    .circle li.benefit-card:nth-child(5) a .title {
        transform: skewY(30deg) rotate(-240deg);
        width: 65px;
        left: 33px;
        top: 80px;
    }

    .circle li.benefit-card:nth-child(6) a .title {
        transform: skewY(30deg) rotate(-300deg);
        width: 105px;
        left: 10px;
        top: 105px;
    }

    .benefit-1 .benefit-info {
        background: #1362BC !important;
    }

    .benefit-2 .benefit-info {
        background: #2580C4 !important;
    }

    .benefit-3 .benefit-info {
        background: #1A498E !important;
    }

    .benefit-4 .benefit-info {
        background: #0E4C7A !important;
    }

    .benefit-5 .benefit-info {
        background: #2B4CA2 !important;
    }

    .benefit-6 .benefit-info {
        background: #0080B9 !important;
    }

    /* Common circular style */
    .circle li.benefit-card a .icon-img {
        border-radius: 50%;
        display: inline-block;
        position: absolute;
        width: 100px;
        height: 100px;
    }

    /* .circle li.benefit-card a .icon-img img {
        width: 28px;
        height: 28px;
        object-fit: contain;
    } */

    .circle li.benefit-card a .icon-img img {
        position: absolute;
        /* width: 22px;
        height: auto;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%); */
    }

    /* Individual slice positioning */
    .circle li.benefit-card:nth-child(1) a .icon-img {
        top: 151px;
        left: -54px;
        background: linear-gradient(180deg, #F7FAFB 0%, #A5BCCB 100%);
    }

    .circle li.benefit-card:nth-child(2) a .icon-img {
        top: 153px;
        left: -53px;
        background: linear-gradient(6.88deg, #F8FBFC 21.78%, #9FB8C8 100.98%);
    }

    .circle li.benefit-card:nth-child(3) a .icon-img {
        top: 154px;
        left: -51px;
        background: linear-gradient(51.79deg, #F8FBFC 13.69%, #9FB8C8 77.87%);
    }

    .circle li.benefit-card:nth-child(4) a .icon-img {
        top: 153px;
        left: -54px;
        background: linear-gradient(118.06deg, #F8FBFC 30.9%, #9FB8C8 102.51%);
    }

    .circle li.benefit-card:nth-child(5) a .icon-img {
        top: 157px;
        left: -51px;
        background: linear-gradient(168.5deg, #F8FBFC 33.71%, #9FB8C8 85.06%);
    }

    .circle li.benefit-card:nth-child(6) a .icon-img {
        top: 154px;
        left: -52px;
        background: linear-gradient(221.84deg, #F8FBFC 6.74%, #9FB8C8 73.18%);
    }

    .circle li.benefit-card:nth-child(1) a .icon-img img {
        width: 11px;
        top: 13px;
        left: 62px;
    }

    .circle li.benefit-card:nth-child(2) a .icon-img img {
        width: 17px;
        top: 40px;
        left: 77px;
    }

    .circle li.benefit-card:nth-child(3) a .icon-img img {
        width: 20px;
        left: 58px;
        top: 70px;
    }

    .circle li.benefit-card:nth-child(4) a .icon-img img {
        width: 19px;
        left: 24px;
        top: 70px;
    }

    .circle li.benefit-card:nth-child(5) a .icon-img img {
        width: 15px;
        left: 10px;
        top: 43px;
    }

    .circle li.benefit-card:nth-child(6) a .icon-img img {
        width: 16px;
        top: 12px;
        left: 27px;
    }

    /* center-hub removed */
    .benefit-overlay {
        border: 8px solid #FFFFFF;
        width: 420px;
        height: 420px;
        border-radius: 50%;
        text-align: center;
        align-items: center;
        justify-content: center;
        color: #FFFFFF;
        display: flex;
        flex-direction: column;

        /* display: none;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 420px;
        height: 420px;
        border-radius: 50%;
        z-index: 999;
        padding: 40px;
        box-sizing: border-box;
        color: #fff;
        align-items: center;
        justify-content: center;
        text-align: left;
        overflow: hidden;
        border: 8px solid #FFFFFF;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12); */
    }

    .benefit-overlay h3 {
        text-align: center;
        font-size: 22px;
    }

    .benefit-overlay .details {
        display: flex !important;
        flex-direction: row;
        gap: 10px;
        padding: 20px 10px;
    }

    .benefit-overlay .left-icon {
        width: 60px;
        align-items: center;
        justify-content: center;
        display: flex;
    }

    .benefit-overlay .left-icon .icon {
        background: linear-gradient(180deg, #F7FAFB 0%, #A5BCCB 100%);
        border-radius: 100%;
        width: 50px;
        height: 50px;
        padding: 10px;
        text-align: center;
    }

    .benefit-overlay .details ul {
        list-style: disc;
        text-align: start;
        align-items: start;
    }

    .benefit-overlay.show {
        display: flex;
    }

    .benefit-info {
        display: flex;
        flex-direction: column;
    }

    .circle.hidden {
        display: none;
    }

    .circle li.benefit-card:first-child a span {
        transform: skewY(25deg) rotate(0deg);
    }

    .circle li.benefit-card:nth-child(2) a span {
        transform: skewY(30deg) rotate(-60deg);
    }

    .circle li.benefit-card:nth-child(3) a span {
        transform: skewY(30deg) rotate(-120deg);
    }

    .circle li.benefit-card:nth-child(4) a span {
        transform: skewY(30deg) rotate(-180deg);
    }

    .circle li.benefit-card:nth-child(5) a span {
        transform: skewY(30deg) rotate(-240deg);
    }

    .circle li.benefit-card:nth-child(6) a span {
        transform: skewY(25deg) rotate(-300deg);
    }

    @media (max-width: 768px) {
        .circle li.benefit-card a .title {
            position: absolute;
            color: #fff;
            font-weight: 500;
            font-size: 14px;
        }

        .circle li.benefit-card:nth-child(1) a .title {
            transform: skewY(30deg) rotate(0deg);
            top: 93px;
        }

        .circle li.benefit-card:nth-child(2) a .icon-img {
            top: 102px;
            left: -49px;
        }

        .circle li.benefit-card:nth-child(3) a .icon-img {
            top: 102px;
        }

        .circle li.benefit-card:nth-child(4) a .icon-img {
            top: 102px;
        }

        .circle li.benefit-card:nth-child(5) a .icon-img {
            top: 106px;
        }

        .circle li.benefit-card:nth-child(5) a .title {
            left: 19px;
            top: 67px;
        }

        .circle li.benefit-card:nth-child(4) a .title {
            left: -13px;
            top: 68px;
        }

        .circle li.benefit-card:nth-child(3) a .title {
            left: -3px;
            top: 56px;
        }

        .circle li.benefit-card:nth-child(2) a .title {
            left: 5px;
            top: 80px;
            padding: 0px 30px;
        }

        .circle li.benefit-card:nth-child(1) a .icon-img {
            top: 127px;
            left: -25px;
        }

        .circle li.benefit-card:nth-child(1) a .icon-img img {
            left: 32px;
        }

        .circle li.benefit-card:first-child a span {
            transform: skewY(47deg) rotate(0deg);
        }

        .circle li.benefit-card:nth-child(6) a .title {
            /* transform: skewY(30deg) rotate(-300deg); */
            width: 119px;
            left: 4px;
            top: 99px;
        }

        .circle li.benefit-card:nth-child(6) a .icon-img {
            top: 104px;
        }

    }

    @media (max-width: 520px) {
        .benefits-wrapper {
            width: 320px;
            height: 320px;
        }

        .circle {
            width: 320px;
            height: 320px;
        }

        .benefit-overlay {
            width: 320px;
            height: 320px;
            padding: 28px;
            border-width: 6px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const circle = document.querySelector('.circle');
    const items = document.querySelectorAll('.benefit-card');
    const overlay = document.querySelector('.benefit-overlay');
    const LOOP_SPEED = 10000; // 2.2 sec
    let index = 0;
    let showCircle = true; 
    let loopTimeout = null; 

    function showOverlay(item) {
        const info = item.querySelector('.benefit-info');
        overlay.innerHTML = info.innerHTML;

        // Background color set
        let bgColor = '#1d7bb4'; 
        for (let i = 1; i <= 6; i++) {
            if (item.classList.contains(`benefit-${i}`)) {
                switch (i) {
                    case 1: bgColor = '#1362BC'; break;
                    case 2: bgColor = '#2580C4'; break;
                    case 3: bgColor = '#1A498E'; break;
                    case 4: bgColor = '#0E4C7A'; break;
                    case 5: bgColor = '#2B4CA2'; break;
                    case 6: bgColor = '#0080B9'; break;
                }
                break;
            }
        }

        overlay.style.background = bgColor;
        overlay.classList.add('show');
        circle.classList.add('hidden');
        items.forEach(it => it.classList.remove('active'));
        item.classList.add('active');
    }

    function hideOverlay() {
        overlay.classList.remove('show');
        overlay.innerHTML = '';
        circle.classList.remove('hidden');
        items.forEach(it => it.classList.remove('active'));
    }

    function loopBenefits() {
        clearTimeout(loopTimeout); 
        if (showCircle) {
            hideOverlay();
            showCircle = false;
        } else {
            showOverlay(items[index]);
            index = (index + 1) % items.length;
            showCircle = true;
        }
        loopTimeout = setTimeout(loopBenefits, LOOP_SPEED); 
    }

    // Start the auto-loop
    loopBenefits();

    // Hover functionality
    items.forEach((item, idx) => {
        item.addEventListener('mouseenter', () => {
            clearTimeout(loopTimeout); 
            showOverlay(item);
        });

        item.addEventListener('mouseleave', (e) => {
            const related = e.relatedTarget;
            if (overlay.contains(related)) {
                return;
            }

            hideOverlay();
            index = idx; 
            showCircle = true;
            loopTimeout = setTimeout(loopBenefits, LOOP_SPEED);
        });
    });

    overlay.addEventListener('mouseleave', () => {
        hideOverlay();
        loopTimeout = setTimeout(loopBenefits, LOOP_SPEED);
    });
});
</script>
