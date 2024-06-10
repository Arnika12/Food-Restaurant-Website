<?php
    include 'connect.php'; 
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }
?>

<style type="text/css">
    <?php  
        include '../style.css'; 
        include 'css/terms.css';
    ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../uploaded_img/icon.png" type="image">
    <title>Crave Harbour - Terms & Condition Page</title>
</head>

<body>
<?php include 'user_header.php'; ?>
<div class="header2">
        <div class="backtohome">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M4.81 8.74697H13.9966V7.24697H4.81095L7.52932 4.52961L6.46886 3.46875L2.46959 7.46654C2.32891 7.60716 2.24985 7.79791 2.24982 7.99683C2.24978 8.19574 2.32876 8.38652 2.46939 8.5272L6.46866 12.528L7.52952 11.4675L4.81 8.74697Z"
                    fill="black"></path>
            </svg>
            <a href="../home.php">Back to Home</a>
        </div>
        <button class="print-button" onclick="window.print()"><i class="fa-solid fa-print"
                style="margin-right: 10px;"></i>Print</button>
    </div>
    <div class="terms-container">
        <h1 style="color: blue;"><b>Terms and Conditions</b></h1>
        <p>This document is an electronic record in terms of Information Technology Act, 2000 and rules there under as
            applicable and the amended provisions pertaining to electronic records in various statutes as amended by the
            Information Technology Act, 2000. This document is published in accordance with the provisions of Rule 3 (1)
            of
            the Information Technology (Intermediaries guidelines) Rules, 2011 that require publishing the rules and
            regulations, privacy policy and Terms of Use for access or usage of Website and Application.</p>
            <br>
            <article>
            <h3>1. TERMS OF USE</h3>
            <p><strong>a."</strong><span>These terms of use (the 'Terms of Use') govern your use of our website
                </span><a href="/" class="style__Link-sc-1kk0npm-2 kztkXU link desc-link"
                    previewlistener="true">www.eatsure.com</a><span> (the 'Website') (the 'Website') and our EatSure
                    application for mobile and handheld devices (the 'App'). The Website and the App are jointly
                    referred to
                    as the 'Platform'. Please read these Terms of Use carefully before you use the services. If you do
                    not
                    agree to these Terms of Use, you may not use the services on the Platform, and we request you to
                    uninstall the App. By installing, downloading or even merely using the Platform, you shall be
                    contracting with EatSure and you signify your acceptance to the Terms of Use and other EatSure
                    policies
                    (including but not limited to the Cancellation &amp; Refund Policy, Privacy Policy and Take Down
                    Policy)
                    as posted on the Platform from time to time, which takes effect on the date on which you download,
                    install or use the Services, and create a legally binding arrangement to abide by the same.</span>
            </p><br>
            <p><strong>b."</strong>The Platform is owned by Rebel Foods Private Limited and operated by Rebel
                Marketplace India Private Limited incorporated under the Companies Act, 2013 and having its registered
                office at Office No. 101, 1st Floor, Lalwani House B Plot No. 78 and 79, Sakore Nagar, Viman nagar Pune
                411014, Maharashtra, India. For the purpose of these Terms of Use, wherever the context so requires,
                'you'
                shall mean any natural or legal person who has agreed to become a buyer or customer on the Platform by
                providing data for registration while registering on the Platform as a registered user using any
                computer
                systems. The terms 'EatSure', 'we', 'us' or 'our' shall mean Rebel Marketplace India Private Limited.
            </p><br>
            <p><strong>c."</strong>EatSure enables transactions between registered restaurants/brands and buyers,
                dealing in food and beverages ('Platform Services'). The customers can choose and place orders
                ('Orders')
                from a variety of products listed and offered for sale by various restaurants/brands (“EatSure Partner”)
                on
                the Platform. EatSure facilitates and ensures delivery of such Orders at select localities of
                serviceable
                cities across India ('Delivery Services'). The Platform Services and Delivery Services are collectively
                referred to as 'Services'.</p>
        </article>
        <br><br>
        <article>
            <h3>2. AMENDMENTS</h3>
            <p>These Terms of Use are subject to amendments at any time. We reserve the right to modify these Terms of
                Use
                and other EatSure policies at any time by posting changes on the Platform, and you shall be liable to
                update
                yourself of such changes, if any, by accessing the changes on the Platform. You shall, at all times, be
                responsible for regularly reviewing the Terms of Use and the other EatSure policies and note the changes
                made on the Platform. Your continued use of the services after any change is posted shall imply your
                acceptance of the amended Terms of Use and other EatSure policies as may be applicable. EatSure grants
                you a
                non exclusive, non transferable, limited right to access and use the Platform, subject to adherence to
                these
                Terms of Use.</p>
        </article>
        <br><br>
        <article>
            <h3>3. USE OF THE PLATFORM</h3>
            <p><strong>a."</strong>All offers availed by a customer are agreed between customers and EatSure Partners
                alone. The term ‘offer’ shall include but not be limited to price, taxes, shipping costs, payment
                methods,
                payment terms, date, period and mode of delivery, warranties related to products and services and after
                sales services related to products and services. We do not have any control or do not determine or
                advise or
                in any way involve ourselves in such offers. We, however, might offer support services to EatSure
                Partners
                with respect to order fulfilment, payment collection, call centre, and other services, pursuant to
                independent contracts executed by us with these EatSure Partners.</p>
                <br>
            <p><strong>b."</strong>EatSure makes no representations or warranties with respect to the specifics of the
                products purchased by the customer (such as legal title, creditworthiness, identity, quality, value,
                etc.)
                of any of the EatSure Partners. You are advised to independently verify the bona fides of any particular
                EatSure Partner that you choose to deal with on the Platform. EatSure shall not accept any liability for
                any
                errors or omissions, whether on behalf of itself or third parties.</p>
                <br>
            <p><strong>c."</strong>EatSure operates as an online marketplace and assumes the role of facilitator, and
                does not at any point of time during any transaction between the customer and EatSure Partner on the
                Platform come into or take possession of any of the products or services offered by such EatSure
                Partner.
                EatSure does not hold any right, title or interest over the products, and therefore shall have no
                obligations or liabilities in respect of such contract entered into between the customer and EatSure
                Partner.</p>
                <br>
            <p><strong>d."</strong>EatSure merely provides a platform for customers to place Orders and any such Order
                shall be construed to be an agreement between the customer and EatSure Partner. In the event a customer
                raises a complaint with respect to the food product delivered, EatSure shall notify the relevant EatSure
                Partner and shall also redirect the customer to the consumer call center of the EatSure Partner. The
                EatSure
                Partners shall be liable for resolving customer complaints. In the event a customer raises a complaint
                on
                the Platform, EatSure shall assist the customer in resolving the same at the best of its abilities.</p>
                <br>
                <p><strong>e."</strong>We shall not be responsible for any non-performance or breach of any contract
                entered into between the customer and the EatSure Partner on the Platform. We do not guarantee that the
                concerned customer and/or EatSure Partner will perform any transaction concluded on the Platform. We
                shall
                not be responsible for unsatisfactory or non-performance of services or damages or delays as a result of
                products which are out of stock, unavailable or back ordered.</p>
        </article><br><br>
        <article>
            <h3>4. ACCOUNT REGISTRATION</h3>
            <p><strong>a."</strong>To access the Platform, You will be asked to provide certain registration details
                and other information. It is a condition of Your use of the Platform that all the information you
                provide on
                the Platform is correct, complete and accurate.</p>
                <br>
            <p><strong>b."</strong>If You choose, or are provided with, a user name, password or any other piece of
                information as part of Our security procedures, You must treat such information as confidential, and You
                must not disclose it to any other person or entity under any circumstances, whatsoever. You also
                acknowledge
                that Your account is personal to You and agree not to provide any other person with access to this
                Website
                or portions of it using Your user name, password or other security information. You agree to notify Us
                immediately of any unauthorized access to or use of Your user name or password or any other breach of
                security. You also agree to ensure that You exit/logout from Your account at the end of each session.
                You
                should use particular caution when accessing Your account from a public or shared computer so that
                others
                are not able to view or record Your password or other personal information.</p>
                <br>
                <p><strong>c."</strong>We shall be entitled to verify details furnished by You, if it deems fit, and in
                case any information furnished is found incorrect, false or misleading and if, in Our opinion, you have
                violated any provision of these Terms of Use, then We shall have the right to disable any user name,
                password or other identifier, whether chosen by You or provided by Us, at any time in Our sole
                discretion.
            </p><br>
            <p><strong>d."</strong>You shall further be liable to be prosecuted and/or punished under applicable laws
                for furnishing false, incorrect, incomplete and/or misleading information to the Platform.</p>
                <br>
                <p><strong>e."</strong>Products and services purchased from the Platform shall be intended for your
                personal use, and you hereby represent that you shall not use the same for resale purposes.</p>
                <br>
                <p><strong>f."</strong>For your ease, we will require basic information about you which shall include but
                not be limited to name, email address, phone number, location,etc. For facilitating payments, we will be
                directing you to a payment gateway website, which shall process your relevant payment information.</p>
        </article><br><br>
        <article>
            <h3>5. ORDER PROCESSING</h3>
            <p><strong>a."</strong>The Platform allows you to place food order bookings and we will, subject to the
                terms and conditions set out herein, enable delivery of such order to you.</p><br>
            <p><strong>b."</strong>We do not own, sell, resell on our own and/or do not control the EatSure Partner or
                the related services provided in connection thereof. You understand that any order that you place shall
                be
                subject to the terms and conditions set out in these Terms of Use including, but not limited to, product
                availability and delivery location serviceability.</p><br>
            <p><strong>c."</strong>As a general rule, all food orders placed on the Platform are treated as confirmed.
                However, upon your successful completion of booking an order, we may call you on the telephone or mobile
                number provided to confirm the details of the order, the price to be paid and the estimated delivery
                time.
                For this purpose, you will be required to share certain information with us, including but not limited
                to
                (i) your first and last name (ii) mobile number; and (iii) email address. It shall be your sole
                responsibility to bring any incorrect details to our attention.</p><br>
            <p><strong>d."</strong>In addition to the foregoing, we may also contact you by phone and / or email to
                inform and confirm any change in the order, due to availability or unavailability or change in price of
                the
                order as informed by the EatSure Partner. Please note change or confirmation of the order shall be
                treated
                as final. It is clarified that EatSure reserves the right to not to process your order in the event you
                are
                unavailable on the phone at the time we call you for confirming the order and such event the provisions
                of
                the cancellation and refund policy below shall be applicable.</p><br>
            <p><strong>e."</strong>All payments made against the purchases/services on the Platform by you shall be
                compulsorily in Indian Rupees acceptable in the Republic of India. The Platform will not facilitate
                transactions with respect to any other form of currency with respect to the purchases made on Platform.
                You
                can pay by (i) credit card or debit card or net banking; (ii) any other RBI approved payment method at
                the
                time of booking an order; or (iii) credit or debit card or cash at the time of delivery. You understand,
                accept and agree that the payment facility provided by EatSure is neither a banking nor financial
                service
                but is merely a facilitator providing an electronic, automated online electronic payment, receiving
                payment
                on delivery, collection and remittance facility for the transactions on the Platform using the existing
                authorized banking infrastructure and credit card payment gateway networks. Further, by providing
                payment
                facility, EatSure is neither acting as trustees nor acting in a fiduciary capacity with respect to the
                transaction or the transaction price.</p><br>
            <p><strong>f."</strong>You acknowledge and agree that we act as the EatSure Partners payment agent for the
                limited purpose of accepting payments from you on behalf of the said EatSure Partner. Upon your payment
                of
                amounts to us, which are due to the EatSure Partner, your payment obligation to the EatSure Partner for
                such
                amounts is completed, and we are responsible for remitting such amounts to the EatSure Partner. You
                shall
                not, under any circumstances whatsoever, make any payment directly to the EatSure Partner for Order
                bookings
                made using the Platform.</p><br>
            <p><strong>g."</strong>You agree to pay us for the total amount for the order placed by you on the
                Platform. We will collect the total amount in accordance with the terms and conditions of these Terms of
                Use
                and the pricing terms set forth in the applicable menu listing for the particular EatSure Partner.
                Please
                note that we cannot control any amount that may be charged to you by your bank related to our collection
                of
                the total amount, and we disclaim all liability in this regard.</p><br>
            <p><strong>h."</strong>In connection with your order, you will be asked to provide customary billing
                information such as name, billing address and credit card information either to us or our third party
                payment processor. You agree to pay us for the order placed by you on the Platform, in accordance with
                these
                Terms of Use, using the methods described above. You hereby authorize the collection of such amounts by
                charging the credit card provided as part of requesting the booking, either directly by us or
                indirectly,
                via a third party online payment processor or by one of the payment methods described on the Platform.
                If
                you are directed to our third-party payment processor, you may be subject to terms and conditions
                governing
                use of that third party's service and that third party's personal information collection practices.
                Please
                review such terms and conditions and privacy policy before using the Platform services. Once your
                confirmed
                booking transaction is complete you will receive a confirmation email summarizing your confirmed
                booking.
            </p><br>
            <p><strong>i."</strong>The final tax bill will be issued by the EatSure Partner to you along with the Order
                and EatSure is merely collecting the payment on behalf of such EatSure Partner. All applicable taxes and
                levies, the rates thereof and the manner of applicability of such taxes on the bill are being charged
                and
                determined by the EatSure Partner. EatSure holds no responsibility for the legal correctness/validity of
                the
                levy of such taxes. The sole responsibility for any legal issue arising on the taxes shall reside with
                the
                EatSure Partner.</p><br>
            <p><strong>j."</strong>All packaged products listed on the Platform shall be sold at MRP, unless otherwise
                specified by the EatSure Partner. The prices listed on the Platform are as received by us from the
                EatSure
                Partner. The final price charged to you may change during delivery.</p><br>
            <p><strong>k."</strong>The prices reflected on the Platform, including packaging or handling charges, are
                determined solely by the EatSure Partner and are listed based on EatSure Partners information. Very
                rarely,
                prices may change at the time of placing Order due to EatSure Partner changing the menu price without
                due
                intimation and such change of price is at the sole discretion of the EatSure Partner attributing to
                various
                factors beyond control.</p><br>
            <p><strong>l."</strong>When you opt for a pickup/takeaway, you agree to be solely liable to ensure
                compliance with the conditions governing the takeaway at the time of placing the order, and we shall not
                be
                liable in any manner in this regard. For the purpose of clarity, pickup/takeaway shall mean where an
                EatSure
                Partner has agreed to provide an option to you to collect your order on your accord from the premises of
                the
                EatSure Partner, by placing the order on the Platform. We accept no liability associated with food
                preparation by the EatSure Partner who accepts the order. All food preparation and handover through
                takeaway
                is the responsibility of the EatSure Partner only. The timings for pickup/takeaway facility for a
                particular
                EatSure Partner shall reflect on the Platform for your ease of access and reference.</p>
                <br>
                <p><strong>m."</strong>The pick-up/takeaway services available on the Platform are offered by and agreed to
                between you and the EatSure Partner alone. We assume the role of a facilitator only and merely provide a
                Platform to facilitate pick-up/takeaway services between the EatSure Partner and You. We shall not be
                held
                responsible at any time for any transactions pertaining to pick up/takeaway orders as offered by the
                EatSure
                Partner.</p><br>
            <p><strong>n."</strong>The EatSure Partner shall provide services as per your sole instructions. We do not
                have any control, do not determine/advise or in any way involve ourselves in the takeaway services. You
                agree that the details of the items for pick-up/takeaway services are provided or entered by you in the
                Platform, in accordance with which the EatSure Partner shall fulfill your order. We shall not be held
                responsible for any issues concerning such orders as they are fulfilled as per your instructions.</p>
                <br>
                <p><strong>o."</strong>Disclaimer: Prices on any product(s) as reflected on the Platform may, due to some
                technical issue, typographical error or product information supplied; be incorrectly reflected, in such
                an
                event EatSure Partner may cancel your Order(s).</p><br>
            <p><strong>p."</strong>The EatSure Partner shall be solely responsible for any warranty/guarantee of the
                food products sold to you and in no event shall be the responsibility of EatSure.</p>
                <br>
                <p><strong>q."</strong>The transaction is bilateral between the EatSure Partner and you and therefore,
                EatSure is not liable to charge or deposit any taxes applicable on such a transaction.</p>
        </article><br><br>
        <article>
            <h3>6. REFUNDS AND CANCELLATIONS</h3>
            <p><strong>a."</strong>As a general rule you shall not be entitled to cancel your order once placed. You
                may choose to cancel your order only within one-minute of the order being placed by you. However,
                subject to
                your previous cancellation history, we reserve the right to deny any refund to you pursuant to a
                cancellation.</p><br>
            <p><strong>b."</strong>If you cancel your order after one minute of placing it, we have a right to charge
                you 100% of the order amount as the cancellation fee , with a right to either not to refund the order
                value
                in case your order is prepaid or recover from your subsequent order in case your order is postpaid, to
                compensate our restaurant/merchants and delivery partners.</p><br>
            <p><strong>c."</strong>We reserve the right to charge you cancellation fee for the orders constrained to be
                cancelled by us for reasons not attributable to us, including but not limited to:<br>
            <ul>
                <li>in the event if the address provided by you is either wrong or falls outside the delivery zone;</li>
                <li>failure to contact you by phone or email at the time of delivering the order booking;</li>
                <li>failure to deliver your order due to lack of information, direction or authorization from you at the
                    time of delivery; or</li>
                <li>unavailability of all the items ordered by you at the time of booking the order. However, in the
                    unlikely event of an item on your order being unavailable, We will contact you on the phone number
                    provided to us at the time of placing the order and inform you of such unavailability. In such an
                    event
                    you will be entitled to cancel the entire order and shall be entitled to a refund to an amount upto
                    100%
                    of the order value.</li>
            </ul>
            </p><br>
            <p><strong>d."</strong>In case of cancellations for the reasons attributable to us or EatSure Partner or
                delivery partners, we shall not charge you any cancellation fee.</p><br>
            <p><strong>e."</strong>You may be entitled to a refund for prepaid orders post deduction of cancellation
                fee as described above or in a manner as deemed fit by us in our sole discretion. You shall also be
                entitled
                to a refund of portionate value in the event packaging of an item in an order or the complete order, is
                either tampered or damaged and you refuse to accept at the time of delivery.</p><br>
            <p><strong>f."</strong>You may be entitled to a refund upto 100% of the order value if our delivery partner
                fails to deliver the order to you due to any cause attributable to us, however such refunds will be
                assessed
                on a case to case basis by us. Our decisions on refunds and cancellations shall be final and binding.
            </p><br>
            <p><strong>g."</strong>All refund amounts shall be credited to your account as may be stipulated as per the
                payment mechanism of your choice.</p><br>
            <p><strong>h."</strong>In case of payment at the time of delivery, you will not be required to pay for:
                <br>
                <ul>
                <li>orders where packaging is either tampered or damaged at the time of delivery;</li>
                <li>wrong order being delivered;</li>
                <li>items missing from your order at the time of delivery.</li>
            </ul>
            </p><br>
            <p><strong>i."</strong>In case of payments made online/at the time of ordering, you shall be entitled to
                refund of 100% of order value if:<br>
            <ul>
                <li>Packaging of the order is tampered/damaged at the time of delivery;</li>
                <li>Wrong order has been delivered;</li>
                <li>Items are missing from your order at the time of delivery.</li>
            </ul><br>
            <p>However, you shall be liable to promptly inform the Company on the Platform, with photographs and proofs
                of
                the damaged/incorrect/incomplete order. The Company shall reserve the right to process your complaint
                based
                on the proof submitted by you.</p>
            </p>
        </article><br><br>
        <article>
            <h3>7. GENERAL TERMS OF USE</h3>
            <p><strong>a."</strong>Use of the Platform is available only to natural and/or legal persons who can enter
                into a legally binding contract under Indian Contract Act, 1872. Persons who are 'incompetent to
                contract'
                within the meaning of the Indian Contract Act, 1872 are not eligible to use the Platform in any manner.
                If
                You are a minor, i.e. under the age of 18 (eighteen) years, You shall not register as a User of the
                Platform
                and shall not transact on or use the same. As a minor if You wish to use or transact on the Platform,
                such
                use or transaction may be only made by Your legal guardian or parents on Your behalf on the Platform.
                The
                Platform reserves the right to terminate Your membership and/or refuse to provide You with access to the
                Platform if it is brought to the Platforms notice or if it is discovered that you are under the age of
                18
                (eighteen) years. The Platform reserves the right to initiate legal action against any person who
                solicits a
                minor to register as a customer on the Platform.</p><br>
            <p><strong>b."</strong>The details of the menu and price list available on the Platform are based on the
                information provided by EatSure Partners and we shall not be responsible for any change or cancellation
                or
                unavailability of the same.</p><br>
            <p><strong>c."</strong>Any delivery time period quoted shall be an approximate time frame, and EatSure
                shall not be held liable for any delayed delivery of the Orders. The customers Order shall be delivered
                only
                to the address mentioned as the delivery address. EatSure shall not be liable for any unfulfilled Order
                deliveries in the event there is a change in the delivery location. The customer shall not be entitled
                to
                any refund or credits on cancellation of such Orders.</p><br>
            <p><strong>d."</strong>The liability of EatSure ends when the Order has been delivered to you. Any use of
                the Platform is at your sole risk and discretion.</p><br>
            <p><strong>e."</strong>EatSure Partners are not endorsed by us.</p><br>
            <p><strong>f."</strong>You agree that the use of the Services does not include the provision of a computer
                or mobile device or other necessary equipment to access it. You also understand and acknowledge that the
                use
                of the Platform requires internet connectivity and telecommunication links. You shall bear the costs
                incurred to access and use the Platform and avail the Services, and we shall not, under any
                circumstances
                whatsoever, be responsible or liable for such costs.</p><br>
            <p><strong>g."</strong>You agree and grant permission to EatSure to receive promotional SMS and e-mails. In
                case you wish to opt out of receiving promotional SMS or email please send a mail to <a target="_blank"
                    href="mailto:feedback@eatsure.com">feedback@eatsure.com</a>
            </p><br>
            <p><strong>h."</strong>You agree to defend, indemnify and hold harmless the Platform and EatSure against
                any claims, liabilities, damages, judgments, awards, losses, costs, expenses or fees (including
                reasonable
                attorneys' fees) made by any third party and/or penalty imposed due to and/or arising out of breach of
                the
                Terms of Use by the you, and/or violation of any law, rules or regulations and/or the rights of a third
                party and/or the infringement by you including, without limitation, copyright and trademark infringement
                and/or any third party using your account, of any intellectual property and/or other right of any person
                and/or entity.</p><br>
            <p><strong>i."</strong>We expressly state and claim that we will NOT BE RESPONSIBLE for all and any
                liabilities arising out as a consequence of any unauthorised use of debit or credit card.</p>
                <br>
                <p><strong>j."</strong>EatSure reserves its right to alter/ withdraw/ extend any offers/ promotions at any
                time without giving any prior notice &amp; without assigning any reason whatsoever.</p>
        </article><br><br>
        <article>
            <h3>8. YOUR REPRESENTATION AND WARRANTIES</h3>
            <p><strong>a."</strong>All information provided by you in connection with registration is true, accurate
                and legal.</p><br>
            <p><strong>b."</strong>The use of the Platform is personal and no other person or entity shall use the
                Services or the Platform on your behalf. You are responsible for the information stated in your account
                and
                the confidentiality of the same.</p><br>
            <p><strong>c."</strong>You represents and warrant that you are the owner and/or authorized to share the
                information that you give on the Platform and that the information is correct, complete, accurate, not
                misleading, does not violate any law, notification, order, circular, policy, rules and regulations, is
                not
                injurious to any person or is discriminatory with respect to sex, caste, race or religion and/or
                property.
            </p><br>
            <p><strong>d."</strong>You will not submit, post, upload, distribute, or otherwise make available or
                transmit any content that: (a) is defamatory, abusive, harassing, insulting, threatening, or that could
                be
                deemed to be stalking or constitute an invasion of a right of privacy of another person; (b) is bigoted,
                hateful, or racially or otherwise offensive; (c) is violent, vulgar, obscene, pornographic or otherwise
                sexually explicit; (d) is illegal or encourages or advocates illegal activity or the discussion of
                illegal
                activities with the intent to commit them.</p><br>
            <p><strong>e."</strong>All necessary licenses, consents, permissions and rights are owned by you and there
                is no need for any payment or permission or authorization required from any other party or entity to
                use,
                distribute or otherwise exploit in all manners permitted by these Terms of Use and Privacy Policy, all
                trademarks, copyrights, patents, trade secrets, privacy and publicity rights and / or other proprietary
                rights contained in any content that you submit, post, upload, distribute or otherwise transmit or make
                available.</p><br>
            <p><strong>f."</strong>You will not post, submit, upload, distribute, or otherwise transmit or make
                available any software or other computer files that contain a virus or other harmful component, or
                otherwise
                impair or damage the Platform or any connected network, or otherwise interfere with any person or
                entity's
                use or enjoyment of the Platform. Furthermore, you will not post or contribute any information or data
                that
                may be obscene, indecent, pornographic, vulgar, profane, racist, sexist, discriminatory, offensive,
                derogatory, harmful, harassing, threatening, embarrassing, malicious, abusive, hateful, menacing,
                defamatory, untrue or political or contrary to our interest.</p><br>
            <p><strong>g."</strong>You will not use another person's username, password or other account information,
                or another person's name, likeness, voice, image or photograph or impersonate any person or entity or
                misrepresent your identity or affiliation with any person or entity.</p>
        </article><br><br>
        <article>
            <h3>9. ACCESS, ACCURACY AND SECURITY</h3>
            <p><strong>a."</strong>We shall make available the Platform to the customers during the business hours of
                the EatSure Partner. We, however, do not represent that access to the Platform will be uninterrupted,
                timely, error free, free of viruses or other harmful components or that such defects will be corrected.
            </p><br>
            <p><strong>b."</strong>We do not represent or warrant that the Platform will be compatible with any
                hardware that might be used by you. Therefore, we shall not be liable for any damage that may have been
                caused to such hardware.</p><br>
            <p><strong>c."</strong>We reserve the right to suspend or withdraw access to the Platform to you
                personally, or to all users temporarily or permanently at any time without notice. We may any time at
                our
                sole discretion reinstate suspended users. A suspended User may not register or attempt to register with
                us
                or use the Platform in any manner whatsoever until such time that such user is reinstated by us.</p>
        </article><br><br>
        <article>
            <h3>10. INTELLECTUAL PROPERTY</h3>
            <p><strong>a."</strong>We represent, warrant and covenant that all IPR in relation to the Platform is owned
                exclusively or validly licensed by, registered or applied for in the sole name of the Rebel Foods
                Private Limited (or its group companies).</p><br>
            <p><strong>b."</strong>You may print off one copy, and may download extracts, of any page(s) from the
                Platform for your personal reference and you may draw the attention of others within your organisation
                to
                material available on the Platform. If you print off, copy or download any part of the Platform in
                breach of
                these Terms of Use, your right to use the Platform will cease immediately and you must, at our option,
                return or destroy any copies of the materials you have made.</p><br>
            <p><strong>c."</strong>You must not modify the paper or digital copies of any materials you have printed
                off or downloaded in any way, and you must not use any illustrations, photographs, video or audio
                sequences
                or any graphics separately from any accompanying text.</p><br>
            <p><strong>d."</strong>You must not use any part of the materials on the Platform for commercial purposes
                without obtaining a licence to do so from us or our licensors.</p>
        </article><br><br>
        <article>
            <h3>11. THIRD PARTY CONTENT</h3>
            <p>We cannot and will not assure that other users are or will be complying with the foregoing rules or any
                other
                provisions of these Terms of Use, and, as between you and us, you hereby assume all risk of harm or
                injury
                resulting from any such lack of compliance. You acknowledge that when you access a link that leaves the
                Platform, the site you will enter into is not controlled by us and different terms of use and privacy
                policy
                may apply. By assessing links to other sites, you acknowledge that we are not responsible for those
                sites.
                We reserve the right to disable links to and / or from third-party sites to the Platform, although we
                are
                under no obligation to do so.</p>
        </article><br><br>
        <article>
            <h3>12. LIMITATION OF LIABILITY</h3>
            <p>In addition to other limitations and exclusions in EatSures Conditions of use and sale, in no event will
                we
                or our directors, officers, employees, agents or other representations be liable for any direct,
                indirect,
                special, incidental, consequential, or punitive damages, or any other damages of any kind arising out of
                or
                related to EatSure. Our total liability, whether in contract, warranty, tort (including negligence) or
                otherwise,will not exceed the value of the order placed by you. These exclusions and limitations of
                liability will apply to the fullest extent permitted by law and will survive cancellation or termination
                of
                your EatSure Membership.</p>
        </article><br><br>
        <article>
            <h3>13. SEVERABILITY</h3>
            <p>If any provision of the Terms if Use or the Platform and its application thereof to any person or
                circumstance shall be invalid or unenforceable to any extent for any reason including by reason of any
                law,
                the remainder of this Terms of Use and the application of such provision to persons or circumstances
                other
                than those as to which it is held invalid or unenforceable shall not be affected thereby, and each
                provision
                of this Terms of Use shall be valid and enforceable to the fullest extent permitted by Law. Any invalid
                or
                unenforceable provision of this Term of Use shall be replaced with a provision, which is valid and
                enforceable and most nearly reflects the original intent of the invalid and unenforceable provision.</p>
        </article><br><br>
        <article>
            <h3>14. ASSIGNMENT</h3>
            <p>Except as otherwise provided in this Terms of Use, the customer shall not assign its obligations under
                this
                Terms of Use to any other person/third party.</p>
        </article><br><br>
        <article>
            <h3>15. FORCE MAJURE</h3>
            <p>We shall not be liable for any failure and/or delay on its part in performing any of its obligations
                under
                this Terms and Conditions and/or for any loss, damage, costs, charges and expenses incurred and/or
                suffered
                by the customer by reason thereof if such failure and/or delay shall be result of or arising out of
                Force
                Majeure Event set out herein. Explanation: 'Force Majeure Event' means any event due to any cause beyond
                the
                reasonable control including, without limitation, unavailability of any communication system, sabotage,
                fire, flood, earthquake, explosion, acts of God, civil commotion, strikes, lockout, and/or industrial
                action
                of any kind, breakdown of transportation facilities, riots, insurrection, hostilities whether war be
                declared or not, acts of government, governmental orders or restrictions, breakdown and/or hacking of
                the
                Website and/or contents provided for availing the Products and/or services under the Website, such that
                it
                is impossible to perform the obligations under the Agreement, or any other cause or circumstances beyond
                the
                control of the Website hereto which prevents timely fulfilment of obligation of the Website hereunder.
            </p>
        </article><br><br>
        <article>
            <h3>16. GOVERNING LAW, JURISDICTION AND DISPUTE RESOLUTION</h3>
            <p><strong>a."</strong>This Agreement shall be governed by the laws of India without reference to conflict
                of law principles.</p><br>
            <p><strong>b."</strong>Subject to this clause, the courts of Mumbai shall have exclusive jurisdiction to
                determine any dispute arising out of or in relation to these Terms of Use.</p>
        </article><br><br>
        <article>
            <h3>17. CONTACT DETAILS</h3>
            <p>For any questions or comments (including all inquiries unrelated to copyright infringement) regarding
                this
                Platform, please contact us on the details below:
            <p>Grievance officer</p>
            <p>In accordance with Information Technology Act, 2000 and rules made there under, the name and contact
                details
                of the Grievance Officer are provided below:</p>
            <p>Vishal Jadhav</p>
            <p>Phone: +91 7700020020</p>
            <p>Email: goodness@eatsure.com</p>
            <p>Time: 9:00 AM to 4:00 AM (All days)</p>
            </p>
        </article><br><br>
        <article>
            <h3>18. GENERAL DISCLAIMER</h3>
            <p><strong>a."</strong>The Platform may be under upgrades and there might be times where some or all
                functions may not be operational.</p><br>
            <p><strong>b."</strong>Due to limitations that may be faced in providing information that is obtained from
                multiple sources, there could be delays or omissions of third party information on the Platform, due to
                which the functionality of the Platform would not be at full.</p><br>
            <p><strong>c."</strong>We expressly claim that we will not be held liable for any loss arising out of a
                consequence of use of unauthorised credit or debit cards.</p><br>
            <p><strong>d."</strong>You acknowledge that EatSure Partners are third parties with whom we have partnered
                with. You acknowledge and agree that we do not make any representations for the same, and therefore
                shall not be liable for the same.</p><br>
            <p><strong>e."</strong>The materials provided on this Platform are to provide accurate information
                regarding the products, however, this information is provided with the understanding that there are no
                warranties, guarantees or representations. EatSure will not be held liable for any information that
                might prove to be inaccurate.</p><br>
            <p><strong>f."</strong>All information provided on this Platform is on an AS IS basis. We make no
                representation or warranty for the content, timeliness, accuracy or effectiveness for the same.</p>
                <br>
                <p><strong>g."</strong>We shall not be liable for any loss or injury arising out of or relating to the
                information provided on the Platform.</p><br>
            <p><strong>h."</strong>We will not be liable for any damages (including but not limited to direct,
                indirect, incidental, special, exemplary, consequential, damages arising out of personal injury or
                death,
                damages out of loss of profit, loss of data or business interruption) that may result due to the
                Services provided on the Platform.</p>
        </article>
    </div>

    <?php include 'footer.php'; ?>

<?php include 'dark.php'; ?>
<!-- sweetalert cdn link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- custom js link -->
<script type="text/javascript" src="script.js"></script>
<?php include 'alert.php'; ?>
</body>
</html>