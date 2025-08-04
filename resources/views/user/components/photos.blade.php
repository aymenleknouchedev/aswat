 <div class="photos-feature">
     <div class="image-wrapper">
         <img id="photoImage" src="./user/assets/images/b1.jpeg" alt="Feature Algeria">
         <div class="corner-icon">
             @include('user.icons.image')
         </div>
     </div>

     <div class="content">
         <h3 id="photoCategory">البرتغال</h3>
         <h2 id="photoTitle">يوم حزين لكرة القدم.. دموع وانهيارات في وداع ديوغو جوتا الأخير</h2>
         <p id="photoDescription">أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل
             دياز-كانيل، بعد أربع سنوات
             على تظاهرات مناهضة للحكومة.</p>
     </div>
 </div>

 <style>
     .photos-feature img,
     .photos-feature .content {
         transition: opacity 0.5s ease;
     }

     .fade-out {
         opacity: 0;
     }

     .photos-feature {
         display: grid;
         grid-template-columns: 1fr 1fr;
         gap: 40px;
         margin-bottom: 60px;
     }

     .photos-feature .image-wrapper {
         position: relative;
         width: 100%;
         height: 100%;
     }

     .photos-feature img {
         width: 100%;
         height: 100%;
         object-fit: cover;
         display: block;
     }

     .photos-feature .corner-icon {
         position: absolute;
         bottom: 15px;
         left: 20px;
         width: 45px;
         height: 45px;
         color: white;
     }

     .photos-feature .corner-icon img {
         width: 100%;
         height: 100%;
     }

     .photos-feature .content {
         margin-top: 20px;
         display: flex;
         flex-direction: column;
         justify-content: flex-start;
         padding: 20px;
     }

     .photos-feature .content h3 {
         margin: 0;
         color: #999;
         font-size: 12px;
         font-family: asswat-light;
         font-weight: lighter;
         cursor: pointer;
     }

     .photos-feature .content h2 {
         margin: 10px 0 10px;
         font-size: 24px;
         line-height: 1.3;
         font-family: asswat-bold;
         cursor: pointer;
         transition: .2s;
     }

     .photos-feature .content p {
         margin: 0;
         font-size: 17px;
         line-height: 1.6;
         color: #555;
     }

     .photos-feature .content h2:hover {
         text-decoration: underline;
     }

     .fade-out {
         opacity: 0;
     }

     .fade-in {
         opacity: 1;
     }

     #backArrow.disabled,
     #nextArrow.disabled {
         opacity: 0.4;
         cursor: default;
         pointer-events: none;
     }
 </style>
