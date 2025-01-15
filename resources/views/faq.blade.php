@extends('layouts.guest')
@section('page_title','FAQ | Bangladesh Angels Network')
@section('page_content')
<!-- Hero Section -->
<section class="relative bg-green-700 w-full text-white py-20">
    <div class="container mx-auto text-center">
        <h1 class="text-5xl font-extrabold mb-6">How can we help you?</h1>
        <div class="relative w-full max-w-md mx-auto">
            <!-- Search Bar -->
            <input
                type="text"
                placeholder="Search support"
                class="w-full rounded-full border-none py-4 px-6 text-gray-700 focus:outline-none shadow-lg"
            />
            <!-- Search Icon -->
            <span class="absolute right-5 top-1/2 transform -translate-y-1/2 text-green-600 text-2xl">
                🔍
            </span>
        </div>
    </div>
</section>

<!-- Cards Section -->
<section class="container flex justify-center items-center w-full">
    <!-- Card 1 -->
    <div class="flex items-center justify-center border rounded-lg p-8 shadow-lg bg-white hover:shadow-2xl transition duration-200">
        <div class="flex items-center text-center">
            <img src="{{asset('pitch.webp')}}" alt="Pitch Icon" class="w-16 mx-auto mb-4">
            <p class="text-lg font-bold text-gray-700 ml-3">I want to pitch</p>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="flex items-center justify-center border rounded-lg p-8 shadow-lg bg-white hover:shadow-2xl transition duration-200">
        <div class="flex items-center text-center">
            <img src="{{asset('investicon.webp')}}" alt="Invest Icon" class="w-16 mx-auto mb-4">
            <p class="text-lg font-bold text-gray-700 ml-3">I want to invest</p>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="container mx-auto mt-16 px-4">
    <h2 class="text-center text-3xl font-bold mb-8 text-gray-800">FAQ</h2>
    <p class="text-center text-gray-500 mb-8">
        Discover frequently asked questions that people face
    </p>
    
    <!-- FAQ List -->
    <div class="space-y-4 max-w-3xl mx-auto">
        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer"> What does BAN actually do?</summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                <ul>
                    <li class="my-3">
                        Who are we looking for? What's our focus: Pre Seed to Seed stage (although we’ve done Series As/Bs/Cs recently), some kind of product or service underpinned by digital technology, full time founders, 1-2 years of operations, generating user traction and currently on post revenue stage but nowhere near product market fit., looking for typically anywhere from $50k to $500k, but sweet spot: $100k-250k 
                    </li>
                    <li class="my-3">
                        We work with these companies on their pitch deck, their data room, their fundraising strategy, and we often pair them up with mentors from our pool of members to coach them, and we watch them, sometimes for a few weeks, sometimes for a few months, to see how they execute on their plans 
                    </li>
                    <li class="my-3">
                        At some point, we make a decision to put them in front of our members in these weekly calls where they get to pitch 
                    </li>
                    <li class="my-3">
                        From there, we facilitate one to one meetings with those who are interested in the company
                    </li>
                    <li class="my-3">
                        Once that happens, we try to create a working group (e.g. syndicate) that works with the BAN team to deep dive into the due diligence including legal, financial and business data.
                    </li>
                    <li class="my-3">
                        And we try to come to a decision on a few things - 1. Are we going to invest? 2. How much? And how much will each person invest in the syndicate and 3. What terms? -- distilled into one common term sheet and from there, we draft investment agreements, after which  the angels would invest money into the companies.
                    </li>
                </ul>
                <p class="font-bold">
                    Clear note: We are not an asset management company - we don’t manage money. So the investors are investing money directly into the companies. But we coordinate the end to end process. 
                </p>
            </p>
        </details>

        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer">What sort of regulations do you face / are you in compliance? </summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                <section class="my-3">
                    In other markets, like the US, angel investing is highly regulated. For example, you have to be an officially “accredited investor” to invest in private equities, including making 200K/year or having assets of 1M+. In Bangladesh, there is no definition (yet) of an accredited investor, and so therefore, angel investing - anyone can be an angel investor. 
                </section>
                <section class="my-3">
                    Now, in terms of rules & regulations, we of course write all of our documents (term sheets, shareholding docs) in compliance with the Companies Act of 1994 in Bangladesh, and the protections it gives to minority investors. They include such things as the right of first refusal on future rounds, and reserve matters on key decisions such as changing the rights of investors. 
                </section>
                <section class="my-3">
                    This is also related to the instruments we use. Typically, in Bangladesh, if you want to invest in equity, there are two primary options. Ordinary shares are common shares, and they’ve the same voting rights as everybody else. We like to use convertible preference shares, which will carry similar voting rights, but have additional rights attached, such as a liquidation preference and anti-dilution, to give certain protections to our investors. 
                </section>
                <section class="my-3">
                    Governance is actually a key value add for us in our investment process. Typically when we come in, these early stage companies don’t have a proper board set up.  We often like to take board director/observer seats.  As part of our investment, especially in the definitive investment agreements, we might place certain conditions (“conditions precedent/subsequent”) as part of completing the transaction, related to things like constituting a board, filing updated tax and RJSC returns, etc. Another thing - we also make it incumbent that all shareholders - existing and incoming - sign shareholding agreements that make it clear to the different classes of investors what rights they have and how the company will be governed in the future. Those are some of the things we do when it comes to governance of the companies in question. 
                </section>
            </p>
        </details>

        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer">How do you see exits happening in this sector?</summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                <section class="my-3">
                    Typically, the scenario depends on where the exit happens.<br><br> 

                    Scenario - company will either from the get-go, and or in the future, redomicile to Singapore or another foreign jurisdiction.  Why do they do this? To get access to start-up friendly capital, at higher valuations than they otherwise can get in Bangladesh. Not every company or founder can do this. Requires international networks, and typically globally recognized credentials (e.g. an international accelerator they’re a part of, or having studied abroad / worked abroad at a recognized company, or all of the above).  But let’s say they do. If that’s the case, then the exits for angels will happen when either a regional tech player / unicorn (from places like Singapore, Indonesia, Australia, China, India, maybe in the future Japan) with a similar business model or in a similar industry invests into the company in order to access the Bangladesh market, or an international VC invests in the company at a Series A, B or C round - typically the exits will happen at B.
                </section>
                <section class="my-3">
                    If the company stays local, then three options.  One a local conglomerate will buy in - right now, most of them are cutting small checks of 300-400K. But more and more are writing 1M, 2M USD cheques. As part of that, will be buying out smaller investors.  Others are local VCs. Right now, there are not a lot of local VCs in Bangladesh, but at least 20 different financial institutions and groups of companies are in the process of launching funds.  They will typically invest in the Seed and Series A stage, and once again, will seek to buy out shares from smaller angel investors (we’ve actually had conversations with certain banks/NBFIs about this).  Third option is still new, but very much possible in the future, is when companies with as little as 500K in paid up capital (i.e. seed-stage startups) can get listed on the Dhaka Stock Exchange’s SME board, and partially offload shares to public investors.  The platform has been launched, and this will be a genuine option in the next 1-2 years.
                </section>
            </p>
        </details>
        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer">How can an exit happen?</summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                <section class="my-3">
                    <ul>
                    <li class="m-3">
                        Secondary sales - to another angel, or VC 
                    </li>
                    <li class="m-3">
                        IPO - if the company goes for IPO 
                    </li>
                    <li class="m-3">
                        Company sale - company is sold to a bigger company 
                    </li>
                    <li class="m-3">
                        Founder sale - founders may elect to buy shareholders out 
                    </li>
                    </ul><br><br> 

                    Scenario - company will either from the get-go, and or in the future, redomicile to Singapore or another foreign jurisdiction.  Why do they do this? To get access to start-up friendly capital, at higher valuations than they otherwise can get in Bangladesh. Not every company or founder can do this. Requires international networks, and typically globally recognized credentials (e.g. an international accelerator they’re a part of, or having studied abroad / worked abroad at a recognized company, or all of the above).  But let’s say they do. If that’s the case, then the exits for angels will happen when either a regional tech player / unicorn (from places like Singapore, Indonesia, Australia, China, India, maybe in the future Japan) with a similar business model or in a similar industry invests into the company in order to access the Bangladesh market, or an international VC invests in the company at a Series A, B or C round - typically the exits will happen at B.
                </section>
                <section class="my-3">
                    This can happen both in Bangladesh and outside Bangladesh <br><br>
                    <ul>
                        <li class="my-3">
                            Instruments: 
                            <ul>
                                <li class="m-3">Depends on jurisdiction -- Equity or convertible preference shares (additional rights over normal shares and anti dilution)</li>
                                <li class="m-3">Redeemable preference shares (additional class of shares that allows the company to buy back at a pre-agreeable price). - Sometimes</li>
                                <li class="m-3">Convertible notes and safe notes (a type of debt which can be turned into equity). -Note: Not legal in Bangladesh. <br>
                                <ul class="m-3">
                                    <li class="ml-6 my-3">Convertibles are safe notes without interest rates.</li>
                                    <li class="ml-6 my-3">Safe notes are a type of debt which can be turned to equity.</li>
                                </ul></li>
                            </ul>
                        </li>
                        <li class="my-3">
                            Screening call, tech driven, problem type, solution type, effectiveness of the solution and stickiness, referrals from our investors, background of founders, we also take help from our member network 
                        </li>
                        <li class="my-3">
                            Seek approval of our board and then put them in front of our members - set up 1-1 calls with interested investors - Decide whether to invest as a group - offer term sheet to the company
                        </li>
                        <li class="my-3">
                            Exit opportunities in Bangladesh: acquisitions, VC rounds etc. 
                        </li>
                        <li class="my-3">
                            Protection to investors from us
                        </li>
                    </ul>
                </section>
            </p>
        </details>
        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer">Are any startups also registered in the US for dealing with any tax issues for USA Investors? Do these syndicates issue k-1 tax forms for USA investors ?</summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                <section class="my-3">
                    Most of the companies that BAN invests in are either registered in Bangladesh or Singapore. Right now, less than 10% of the BAN portfolio are US registered entities, though this is changing rapidly, particularly because platforms for SPVs, registering companies and creating bank accounts in the US are becoming more ubiquitous, making it becoming easier than ever to create a Delaware C company remotely.  We see more and more companies, especially in Saas, being registered in the US. Moreover, we are working with a few platforms and North American members, to create SPVs to collate the investments of those from the region to invest in our portfolio.  When those happen, either BAN or the SPV manager/platform will be responsible for making sure K1s are issued. We are and will be transparent on the process, including on-going management of SPVs, before each deal.
                </section>
            </p>
        </details>
        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer">Why BAN vs Investing in VC</summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
               <ul>
                    <li class="my-3">
                        VCs typically have high tickets to enter their funds, and you have to meet certain criteria as well in countries like US (“sophisticated investor” - certain amount of assets) - if you have that kind of network/access, then you should look at investing in VC
                        <li class="ml-3">
                            With BAN deals, especially if we are running them on something like Angellist, you can invest as little as $1-5K 
                        </li>
                    </li>
                    <li class="my-3">
                        With VCs, you have to buy into the fund; it’s not discretionary, deal by deal basis. You are dependent on the VC to make those choices on your behalf, and you only get out when the fund closes, not when the individual company gives returns. So this can be 10+ years. 
                        <li class="ml-3">
                            With BAN deals, you can get exit in as little as 12 months (has happened - not typical, but possible) 
                        </li>
                    </li>
                    <li class="my-3">
                        You don’t get access, typically, as an LP, to the portfolio founders. You don’t get the benefit of talking to them during due diligence, or helping them post-investment, unless you’re willing to co-invest alongside the VC. It’s completely passive, unless you’re investing millions of dollars. 
                        <li class="ml-3 font-bo">
                            Our angels have direct access to founders and we make sure that happens 
                        </li>
                    </li>
               </ul>
            </p>
        </details>
        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer">When do investors get shares?
            </summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                <section class="my-3">
                   <li class="my-3">
                    In bangladesh - post RJSC filing - is when it’s official; Still official though when board resolution is issued post-investment agreement
                   </li>
                   <li class="my-3">
                    In SG - there are annual filings of stockholders, but once again, board resolution post-investment agreement and disbursement 
                   </li>
                </section>
            </p>
        </details>
        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer">Can Bangladeshis partake in SPVs?</summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                <section class="my-3">
                    Locally, you can create an SPV - it’s simple. Create a limited company, with multiple shareholders. That company in turn invests in another company.  It has happened in the ecosystem. We are also exploring that for a couple of companies. 
                    <li class="ml-3 mt-3">
                        Where the challenge is, that you’re subject to taxation at multiple levels - the investee company has to pay dividend tax before sending money to the holding company, who then is subject to dividend tax again before sending to its shareholders, who might have to pay income tax 
                    </li>
                </section>
                <section class="my-3">
                    Can a Bangaldeshi own shares in a foreign (US/SG/UK) SPV? Yes and no.                     
                    <li class="ml-3 mt-3">
                        Certain SPV platforms that automate SPV creation, which makes it very convenient - they do want you to invest directly in the SPV; so if you can’t (and you’re Bangladehsi and your accounts are in Bangladesh) then you can’t invest in that SPV (“know your customer” rules) 
                    </li>
                    <li class="ml-3">
                        What you can do, is to have a relative or friend abroad invest in the SPV on your behalf, and maybe remit money (will have to explain your bank what it is for, might say “gift” or remittance)
                    </li>
                    <li class="ml-3">
                        If you have money abroad abroad, are willing to invest that money abroad into an SPV, then you can take shares (though from BD government standpoint, you shouldn’t do that/have that) so will be an issue for you if you decide to repatriate those funds; But if you don’t, and just take the capital gains abroad, then not a problem.
                    </li>
                </section>
            </p>
        </details>
        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer"> What is the criteria for investment?</summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                <section class="my-3">
                    <li class="ml-3">
                        Technology-enabled (not just having a website or an app), but using technology in a meaningful way to deliver value, maximize efficiency 
                    </li>
                    <li class="ml-3">
                        Ideally at least 1 year in the market, with users and potentially paid customers
                    </li>
                    <li class="ml-3">
                        Full-time founders (not everyone, but ideally the CEO/COO and CTO) 
                    </li>
                    <li class="ml-3">
                        Solving a scalable problem for Bangladesh, especially as the country undergoes rapid changes 
                    </li>
                    <li class="ml-3">
                        A great solution that is not a replica of something in the market, or a shiny new object, but something that is 5-10x better than alternatives  
                    </li>
                    <li class="ml-3">
                        A true unfair advantage (You can read more about how we think about opportunities <a class="text-indigo-700" href="https://bangladesh-angels-network.medium.com/how-to-screen-startup-ideas-in-a-frontier-market-7769c79251a0">here</a> )
                    </li>
                    <li class="ml-3">
                        Independent company - not a spin-off/subsidiary of an existing company 
                    </li>
                    <li class="ml-3">
                        Fits our sweet spot for funding - looking for $100-200K 
                    </li>
                </section>
            </p>
        </details>
        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer">What legal documents do investors / members need when investing?</summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                <section class="my-3">
                    <li class="m-3">
                        Term sheet - sets out the terms for investment, but not final / legally-binding to either party 
                    </li>
                    <li class="m-3">
                        Share purchase agreement - essentially a legalized version of the term sheet, setting out the terms under which the investor puts in money, what they get in return (rights, # of shares, etc.) 
                    </li>
                    <li class="m-3">
                        Shareholding agreement - signed by all the existing and incoming shareholders in a company, setting out how the company will be governed, the rights of each party (founders, existing investors and new investors) vis a vis each other. A new version is written every round.
                    </li>
                </section>
            </p>
        </details>
        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer">Do we have to negotiate the terms of investment with the startups directly or BAN is going to do on behalf of us?</summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                <section class="my-3">
                    We will assist the negotiation of the terms by being an honest broker between the two sides (investors/syndicate and the founders). Since we are accountable to both sides (to investors via membership fees, and to entrepreneurs via success fees), our aim is to get the deal done. We will never dictate terms to one side of the other. That's a major part of our value addition, is the mediation component.
                </section>
            </p>
        </details>
        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer">How are we going to pay for the investment? Will it be through BAN, or will it be done individually through each startup?</summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                <section class="my-3">
                    You will never give money directly to BAN for investments. Your investments will either go into the accounts of the company, or through a Special Purpose Vehicle set up for the purpose of investing in that company.
                </section>
            </p>
        </details>
        
    </div>
</section>
@endsection