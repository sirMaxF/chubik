import { ItcSimpleSlider } from './modules/simple-adaptive-slider.js'

// flsFunctions.isWebp();


// слайдер

// import Swiper, { Navigation, Pagination } from 'swiper';

// Swiper.use([Navigation, Pagination]);
// или же можем подключить и активировать сразу все модули. Но они весят очень много!!!
// import Swiper from 'swiper/bundle';
// Swiper.use();

// const swiper = new Swiper('.swiper', {

//     navigation: {
//         nextEl: '.swiper-button-next',
//         prevEl: '.swiper-button-prev'
//     },

//     slidesPerView: 2,
// });



//! адаптивное меню

try {
    const menuIcon = document.querySelector('.menu__icon');
    const headerMenu = document.querySelector('.menu__row');

    menuIcon.addEventListener('click', () => {
        headerMenu.classList.toggle('_active');
    })
} catch (error) {

}

//! выпадающее меню

try {
    const mQuery = window.matchMedia('(max-width: 818px)');

    if (mQuery.matches) {
        const nth2 = document.querySelector('.menu__item:nth-child(2)');
        nth2.addEventListener('click', () => {
            nth2.lastElementChild.classList.toggle('_active');
        })
    }
} catch (error) {

}

//! слайдер

// try {
//     const mainCarousel = document.querySelectorAll('.main__carousel>*');
//     window.onload = () => {
//         setTimeout(() => {
//             mainCarousel.forEach((value, index) => {
//                 if (index === 1) {
//                     const parent = value.parentElement.prepend(value);
//                     value.classList.add('_active')
//                 } else {
//                     value.classList.remove('_active')
//                 }
//             })
//         }, 1000)

//     }

// } catch (error) {

// }



// document.addEventListener('DOMContentLoaded', () => {
//     // инициализация слайдера
//     new ItcSimpleSlider('.itcss', {
//         loop: true,
//         autoplay: true,
//         interval: 5000,
//         swipe: true,
//     });
// });

//! Галерея

try {
    const gallery = document.querySelector('.gallery__grid');
    if (gallery.style.transform) {
        gallery.style.transform = '';

    } else {
        gallery.style.transform = 'translateX(-200px)';
        setInterval(() => {
            gallery.style.transform = '';
        }, 8000)
    }



} catch (error) {

}


//! кнопка возврата на главной

try {
    const detailsButton = document.querySelector('.details__button')
    const vozvratOverlay = document.querySelector('.vozvrat__overlay');
    const vozvratContaine = document.querySelector('.vozvrat__container')
    detailsButton.addEventListener('click', () => {
        window.vozvrat.style.display = 'block';
    })

    vozvratOverlay.addEventListener('click', (e) => {
        alert('ff')
        if (!e.target.classList.contains('vozvrat__overlay')) {
            return false;
        }
        window.vozvrat.style.display = 'none';

    })

} catch (error) {

}

//! input range

try {
    // window.onload = () => {
    const formsTtle = document.querySelector('.forms__title span');
    const inputTypeRange = document.querySelector('input[type="range"]');

    inputTypeRange.addEventListener('change', (e) => {
        let value = e.target.value;
        formsTtle.textContent = '(' + value + ' руб)';
    })
    // }
} catch (error) {

}

//! фильтры 

try {
    const filters = document.querySelector('.filters');
    const forms = document.querySelector('.forms');
    const formsClose = document.querySelector('.forms__close');
    const body = document.querySelector('body');


    filters.addEventListener('click', () => {
        forms.classList.add('_active');
        formsClose.classList.add('_active');
        body.classList.add('_active');
    })
    formsClose.addEventListener('click', () => {
        forms.classList.remove('_active');
        formsClose.classList.remove('_active');
        body.classList.remove('_active');

    })

} catch (error) {

}

//! галареия на single

try {

    // window.onload = () => {

    const kartinkiBig = document.querySelector('.kartinki__big');
    const kartinkiSmall = document.querySelectorAll('.kartinki__small');

    window.onload = () => {
        kartinkiBig && (kartinkiBig.firstElementChild.src = kartinkiSmall[0].firstElementChild.src);
    };

    // kartinkiSmall.forEach(value => value.addEventListener('click', () => {
    //     const src = value.firstElementChild.src;
    //     kartinkiBig.firstElementChild.src = src;
    //     window.BlowupLens.style.backgroundImage = `url(${src})`;
    // }))
    // }

} catch (error) {

}

//! ВРЕМЕННОЕ РЕШЕНИЕ ДЛЯ КНОПКИ КУПИТЬ

try {
    const positionButton = document.querySelectorAll('.position');
    positionButton.forEach(value => value.addEventListener('click', () => {
        window.location.assign('single.html');
    }))
} catch (error) {

}

//! ВРЕМЕННОЕ РЕШЕНИЕ ДЛЯ СПИСКА ТОВАРОВ

try {
    const inputNameOdzhd = document.querySelectorAll('input[name="odzhd"]');
    const selectPositions = document.querySelector('.select__positions');

    function render(arr, renderFlag = false) {
        selectPositions.innerHTML = '';

        arr.forEach(value => {
            selectPositions.insertAdjacentHTML('afterbegin', `
                        <div class="position" ${renderFlag && 'style="opacity: 1"'} onclick="window.location.assign('single.html')">
                            <div class="position__image"><img src="${value.img}" alt=""></div>
                            <div class="position__title">${value.name}</div>
                            <div class="position__price">2100 руб</div>
                            <div class="position__button">Выбрать размер</div>
                        </div>
                    `)
        })
    }

    let result;

    if (inputNameOdzhd) {
        const response = await fetch('https://667c1b9d3c30891b865b56aa.mockapi.io/photos/images');
        result = await response.json();

        render(result);

        // result.forEach(value => {
        //     selectPositions.insertAdjacentHTML('afterbegin', `
        //                 <div class="position">
        //                     <div class="position__image"><img src="${value.img}" alt=""></div>
        //                     <div class="position__title">${value.name}</div>
        //                     <div class="position__price">2100 руб</div>
        //                     <div class="position__button">Выбрать размер</div>
        //                 </div>
        //             `)
        // })
    };
    console.log(result)


    inputNameOdzhd.forEach(value => value.addEventListener('change', (e) => {
        selectPositions.innerHTML = '';
        const inputVal = e.target.value;

        inputNameOdzhd.forEach((item) => {
            if (item !== e.target) item.checked = false
        })

        switch (inputVal) {
            case 'yes1':
                const yes1 = result.filter(value => value.category === '1');
                render(yes1, true);
                break;
            case 'yes2':
                const yes2 = result.filter(value => (value.category === '2'));
                render(yes2, true);
                break;
            case 'yes3':
                const yes3 = result.filter(value => value.category === '9');
                render(yes3, true);
                break;
            case 'yes4':
                const yes4 = result.filter(value => value.category === '4');
                render(yes4, true);
                break;
            // default:
            //     break;

        }

        let isChecked = Array.from(inputNameOdzhd).some(checkbox => checkbox.checked);

        if (!isChecked) {
            render(result, true);
        }



        console.log(inputVal);
    }))

} catch (error) {
    console.log(error)
}

//! ВРЕМЕННОЕ РЕШЕНИЕ ДЛЯ ГАЛЕРЕИ

try {
    const galleryItem = document.querySelectorAll('.gallery__item');
    galleryItem.forEach(value => value.innerHTML = `<img src="./img/aaa.jpg" alt="">`)

} catch (error) {

}

//! обзервер

try {

    const positions = document.querySelectorAll('.position');
    const cardsItems = document.querySelectorAll('.cards__item');
    const katalogElement = document.querySelectorAll('.katalog__element');

    var observer = new IntersectionObserver((entries) => {
        entries.forEach(value => {
            (value.isIntersecting) && (value.target.style.opacity = '1');
        })
    });

    positions && positions.forEach(value => observer.observe(value));
    cardsItems && cardsItems.forEach(value => observer.observe(value));
    katalogElement && katalogElement.forEach(value => observer.observe(value));
} catch (error) {

}

//! кнопка назад

try {
    const singleReturn = document.querySelector('.single__return');
    singleReturn.addEventListener('click', () => {
        window.history.back();
    })
} catch (error) {

}

//! большая картинка

// try {
//     const kartinkiBig = document.querySelector('.kartinki__big img');


//     // kartinkiBig.addEventListener('mousemove', (e) => {
//     //     const y = e.clientY / 2;
//     //     const x = e.clientX / 2;
//     //     // const y = e.offsetTop / 1;
//     //     // const x = e.offsetLeft / 1;
//     //     console.log(x)
//     //     kartinkiBig.style.transform = `translate(-${x}px, -${y}px) scale(3)`;
//     // });

//     let counter = true;
//     kartinkiBig.addEventListener('click', () => {
//         counter = !counter;
//         if (!counter) {
//             kartinkiBig.classList.toggle('_active')

//             kartinkiBig.addEventListener('mousemove', (e) => {
//                 const y = e.clientY / 3;
//                 const x = e.clientX / 3;
//                 kartinkiBig.style.transform = `translate(-${x}px, -${y}px)`;
//             })
//         } else {
//             // counter = !counter;
//             kartinkiBig.classList.toggle('_active')
//             kartinkiBig.addEventListener('mousemove', (e) => {
//                 return false;
//             })
//             kartinkiBig.style.transform = `translate(0px, 0px)`;

//         }

//     })



//     kartinkiBig.addEventListener('mouseout', () => {
//         kartinkiBig.style.transform = `translate(0px, 0px)`;
//     })

// } catch (error) {

// }

//! лупа

// $(document).ready(function () {
//     $(".kartinki__big img").blowup();
// })

//! лупа 2

// try {
//     let zoom = document.querySelectorAll('.image-zoom');

//     zoom.forEach(function (el) {
//         el.addEventListener('click', function (e) {
//             const target = e.target.closest('.image-zoom'),
//                 rect = target.getBoundingClientRect();
//             target.classList.toggle('-active');
//             target.style.setProperty('--image', `url(${target.querySelector('img').getAttribute('src')})`);
//             target.style.setProperty('--x', Math.floor(((e.clientX - rect.left) / rect.width * 100) * 100) / 100 + '%');
//             target.style.setProperty('--y', Math.floor(((e.clientY - rect.top) / rect.height * 100) * 100) / 100 + '%');
//             target.classList.toggle('-enter');
//         });

//         el.addEventListener('mouseenter', function (e) {
//             const target = e.target.closest('.image-zoom');
//             if (target.classList.contains('-active')) {
//                 target.classList.add('-enter');
//             }
//         });

//         el.addEventListener('mousemove', function (e) {
//             const target = e.target.closest('.image-zoom');
//             if (target.classList.contains('-active')) {
//                 const rect = target.getBoundingClientRect();
//                 target.style.setProperty('--x', Math.floor(((e.clientX - rect.left) / rect.width * 100) * 100) / 100 + '%');
//                 target.style.setProperty('--y', Math.floor(((e.clientY - rect.top) / rect.height * 100) * 100) / 100 + '%');
//             }
//         });

//         el.addEventListener('mouseleave', function (e) {
//             let target = e.target.closest('.image-zoom');
//             if (target.classList.contains('-active')) {
//                 target.classList.remove('-enter');
//             }
//         });
//     });
// } catch (error) {

// }

//! переключение галереи

try {
    const kartinkiBig = document.querySelector('.kartinki__big');
    const popnewOverlay = document.querySelector('.popnew__overlay');
    const popnewContainer = document.querySelector('.popnew__container')
    const vozvratNew = document.querySelector('.vozvrat_new');

    const kartinkiSmall = document.querySelectorAll('.kartinki__small');
    let count = 0;

    // window.onload = () => {
    if (kartinkiBig) {
        kartinkiBig.addEventListener('click', (e) => {
            if (e.target.parentElement.classList.contains('kartinki__prkl')) {

                if (e.target.parentElement.classList.contains('kartinki__prkl_right')) {
                    ++count;
                    console.log(count)
                    if (count >= (kartinkiSmall.length - 1)) {
                        document.querySelector('.kartinki__prkl_right').style.display = 'none';
                        kartinkiBig.firstElementChild.src = kartinkiSmall[count].firstElementChild.src;
                    } else {
                        kartinkiBig.firstElementChild.src = kartinkiSmall[count].firstElementChild.src;
                    }
                    document.querySelector('.kartinki__prkl_left').style.display = 'block';

                }

                if (e.target.parentElement.classList.contains('kartinki__prkl_left')) {
                    --count;
                    if (count <= 0) {
                        document.querySelector('.kartinki__prkl_left').style.display = 'none';
                        kartinkiBig.firstElementChild.src = kartinkiSmall[count].firstElementChild.src;
                    } else {
                        kartinkiBig.firstElementChild.src = kartinkiSmall[count].firstElementChild.src;
                    }
                    document.querySelector('.kartinki__prkl_right').style.display = 'block';

                }

                return false;
            }


            popnewContainer.style.backgroundImage = `url(${kartinkiBig.firstElementChild.src})`;
            // vozvratNew.classList.add('_active')
            window.popnew.style.display = 'block';
        })


    }
    // }

    popnewOverlay.addEventListener('click', (el) => {
        if (!el.target.classList.contains('popnew__overlay')) {
            return false;
        }
        window.popnew.style.display = 'none';
        // vozvratNew.classList.remove('_active')

    })

} catch (error) {
    console.log(error)
}

//! свайпы

try {


    // var square = document.querySelector('.square');
    // var manager = new Hammer.Manager(square);
    // var Swipe = new Hammer.Swipe();
    // manager.add(Swipe);
    // manager.on('swipe', function (e) {
    //     var direction = e.offsetDirection;
    //     if (direction === 2) {
    //         detailsButton.firstElementChild.src = kartinkiSmall[1].firstElementChild.src;

    //     }
    // });
} catch (error) {

}