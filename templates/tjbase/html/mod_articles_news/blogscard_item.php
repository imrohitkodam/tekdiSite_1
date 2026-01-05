<?php

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
?>

<a href="<?php echo $item->link; ?>" class="text-decoration-none text-dark">
    <div class="article-blogsdetail-card h-100 position-relative d-flex flex-column">
        <div class="image-realtedblogs overflow-hidden" style="height: 200px;">
            <?php if ($params->get('img_intro_full') !== 'none' && !empty($item->imageSrc)): ?>
                <figure class="newsflash-image h-100 m-0">
                    <div class="h-100 w-100"
                        style="background: url('<?php echo $item->imageSrc; ?>') center/cover; transition: transform 0.3s ease;">
                    </div>
                    <?php if (!empty($item->imageCaption)): ?>
                        <figcaption class="position-absolute bottom-0 start-0 w-100 bg-dark bg-opacity-75 text-white p-2 small">
                            <?php echo $item->imageCaption; ?>
                        </figcaption>
                    <?php endif; ?>
                </figure>
            <?php endif; ?>
        </div>

        <div class="card-body d-flex flex-column flex-grow-1 px-0">
            <div class="title-realtedblogs">
                <?php if ($params->get('item_title')): ?>
                    <?php echo $item_heading; ?>
                    <?php echo $item->title; ?>
                    </<?php echo $item_heading; ?>>
                <?php endif; ?>
            </div>

            <div class="realtedblogs-intro-text flex-grow-1 mb-1">
                <?php
                $introText = strip_tags($item->introtext);
                if (strlen($introText) > 150) {
                    echo substr($introText, 0, 140) . '...';
                } else {
                    echo $introText;
                }
                ?>
            </div>

            <div class="realtedblogs-author-date">
                <?php
                $author = !empty($item->author) ? $item->author : 'Tekdi Author';
                $date = !empty($item->publish_up) ? date('d M Y', strtotime($item->publish_up)) : '';
                echo $author . ' | ' . $date;
                ?>
            </div>
        </div>

        <style>
            .article-blogsdetail-card {
                overflow: hidden;
                /* transition: transform 0.3s ease, box-shadow 0.3s ease; */
            }

            /* .article-blogsdetail-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            } */

            .image-realtedblogs {
                margin-bottom: 15px;
                max-width: 100%;
                height: 250px;
                width: 100%;
                object-fit: cover;
            }

            @media (max-width: 767px) {
                .col-md-4 {
                    flex: 0 0 100%;
                    max-width: 100%;
                }

                .image-realtedblogs {
                    width: 100% !important;
                }
            }

            .title-realtedblogs {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
                line-height: 28px;
                max-height: 55px;
                min-height: 55px;
                font-weight: 500;
                color: #484848;
                font-size: 18px;
                margin-bottom: 10px;
            }

            .realtedblogs-intro-text {
                font-size: 14px;
                font-weight: 300;
                line-height: 22px;
                color: #484848;
            }

            .realtedblogs-author-date {
                font-size: 14px;
                font-weight: 300;
                line-height: 22px;
                color: #484848;
                padding-top: 10px;
            }
        </style>
    </div>
</a>
