<?php

namespace App\Support;

class BanFaqs
{
    /**
     * Public FAQ content supplied by Bangladesh Angels Network.
     *
     * @return array<int, array{question: string, paragraphs: array<int, string>, bullets?: array<int, string>, note?: string}>
     */
    public static function all(): array
    {
        return [
            [
                'question' => 'What sort of returns are you seeing or expecting?',
                'paragraphs' => [
                    'Angel investing works best as a portfolio strategy. Investors should ideally build exposure to at least 10 companies - and often 20 to 30 - over a four-to-five-year period rather than rely on a single investment.',
                    'BAN has seen leading Bangladeshi companies such as Sheba and Pathao generate double-digit multiples for some original angel investors. Those outcomes are exceptional, however, and startup investments remain highly risky and illiquid.',
                ],
                'bullets' => [
                    'At least 50% of companies may fail and return no capital.',
                    'Roughly 20-30% may only return the original capital, or about 1x.',
                    'Around 10-20% may produce returns in the 3-5x range.',
                    'One or two standout companies may generate 5-10x or more and carry the portfolio.',
                ],
                'note' => 'These figures are portfolio assumptions, not forecasts or guaranteed returns.',
            ],
            [
                'question' => 'What sort of regulations do you face, and are you in compliance?',
                'paragraphs' => [
                    'In developed markets such as the United States, private startup investing is generally limited to investors who meet formal accreditation requirements. Bangladesh does not currently have an equivalent statutory definition of an accredited investor.',
                    'BAN investment documents, including term sheets and shareholders agreements, are prepared within the applicable framework of the Companies Act, 1994. The agreed rights depend on the company, jurisdiction, share class, and transaction.',
                ],
                'bullets' => [
                    'Ordinary shares generally provide common ownership and voting rights.',
                    'Convertible preference shares may include liquidation preference and anti-dilution protections.',
                    'Investors may receive board director or observer representation for strategic guidance and oversight.',
                    'Conditions before or after closing may require board formation, updated tax filings, and corporate documentation.',
                    'A shareholders agreement defines governance and the rights and responsibilities of founders and investors.',
                ],
            ],
            [
                'question' => 'How do you see exits happening in this sector?',
                'paragraphs' => [
                    'Exit opportunities depend heavily on the company\'s jurisdiction and growth path. Some companies may redomicile to a market such as Singapore to access international capital, strategic buyers, and higher valuations. Others remain headquartered in Bangladesh and pursue local exit routes.',
                ],
                'bullets' => [
                    'A regional technology company may acquire or invest in the business to enter Bangladesh.',
                    'An international venture-capital firm may provide liquidity to early investors during a later Series A, B, or C round.',
                    'A local conglomerate may invest in the company and purchase shares from early angels.',
                    'A Bangladesh-based venture-capital fund may invest at Seed or Series A and offer a secondary component.',
                    'An eligible company may eventually seek a public listing, including through the Dhaka Stock Exchange SME platform.',
                ],
                'note' => 'Exit timing and liquidity are never guaranteed, and not every company will be suitable for each route.',
            ],
            [
                'question' => 'What is my security?',
                'paragraphs' => [
                    'Startup investing is highly risky and there is no guarantee that invested capital will be returned. Investors seeking capital protection may find debt, bonds, or public-market instruments more appropriate.',
                    'BAN focuses on the quality of the investment process: initial team screening, mentoring and observation, governing-board input, investor calls, a structured data room, legal and financial due diligence, and - where agreed - funding in tranches.',
                    'The period before an investment also helps investors evaluate whether founders execute consistently and remain accountable to what they communicate. These safeguards can reduce risk, but they cannot eliminate startup failure.',
                ],
            ],
            [
                'question' => 'How does an NRB or foreigner invest and repatriate the money?',
                'paragraphs' => [
                    'The recommended route is a direct bank-to-bank transfer from the investor\'s overseas account to the investee company\'s Bangladesh bank account, clearly designated as an equity investment. This creates the documentary trail required for share issuance and future repatriation.',
                    'After receiving the funds, the local bank should issue an encashment certificate. The company uses that certificate with the investment agreements and required filings to formalize the share purchase with the Registrar of Joint Stock Companies and Firms (RJSC). Unofficial channels such as hundi should not be used.',
                ],
                'bullets' => [
                    'The supplied guidance states that capital gains up to BDT 10 crore may be repatriated without direct central-bank approval, subject to current rules and documentation.',
                    'Proceeds from listed shares may be handled through a Non-Resident Investors Taka Account (NITA), where applicable.',
                    'Investors remain responsible for reporting foreign shareholdings and gains in their home jurisdiction.',
                    'If the investee company is registered abroad, the investment and exit follow that jurisdiction\'s legal and tax framework.',
                    'Using another person\'s Bangladesh bank account is not recommended because that account holder may be treated as the investor and official repatriation may become impossible.',
                ],
                'note' => 'Banking, foreign-exchange, tax, and repatriation rules can change. Investors should obtain current advice before transferring funds.',
            ],
            [
                'question' => 'Are startups registered in the US, and do syndicates issue K-1 tax forms for US investors?',
                'paragraphs' => [
                    'Most BAN portfolio companies have historically been registered in Bangladesh or Singapore. Fewer than 10% were US-registered at the time of the supplied FAQ, although US incorporation is becoming more common - particularly for software-as-a-service companies and companies using Delaware structures.',
                    'BAN is also exploring special-purpose vehicles with North American members and service platforms. When a US SPV is used, BAN or the relevant SPV manager or platform will explain responsibility for ongoing administration and any applicable K-1 tax reporting before the deal proceeds.',
                ],
            ],
            [
                'question' => 'Are there local Bangladesh taxes each year or on an exit for foreign investors?',
                'paragraphs' => [
                    'According to the supplied guidance, a foreign investor generally does not make annual Bangladesh tax filings solely because they hold shares, unless they are resident in Bangladesh or derive regular income from Bangladesh.',
                    'The investee company is responsible for obtaining an encashment certificate for foreign funds and completing applicable registrations, including with the Bangladesh Investment Development Authority where required before repatriation. A foreign investor establishing their own local entity may have additional obligations.',
                ],
                'note' => 'Tax treatment depends on residency, source of income, structure, and current law. Independent tax advice is essential.',
            ],
            [
                'question' => 'What legal protections are there for investors?',
                'paragraphs' => [
                    'Investment risk must be distinguished from fraud or operational misconduct. The principal remains at risk in any startup investment, so investors should use discretionary capital, build a diversified portfolio, and be prepared for a five-to-seven-year holding period.',
                    'Legal and procedural protections can help address fraud, mismanagement, and governance disputes, while comprehensive due diligence is the strongest preventative measure.',
                ],
                'bullets' => [
                    'Minority shareholders may seek legal protection when a board acts against their interests, and BAN may help mediate disputes.',
                    'Investment agreements may use arbitration under the Arbitration Act, 2001 as a formal dispute-resolution mechanism.',
                    'Suspected theft or misappropriation can be referred to law enforcement; bank transfers and cheques preserve a clear audit trail.',
                    'BAN screens founders, checks ecosystem reputation, reviews the data room, and may coordinate professional legal or financial due diligence.',
                    'Capital should only be released once diligence is complete and the investor is comfortable with the risks and documents.',
                ],
            ],
            [
                'question' => 'Is dual listing allowed?',
                'paragraphs' => [
                    'Multinational companies can have a listed parent in one market and a locally listed subsidiary in Bangladesh. A similar structure may eventually be possible for startups, with an overseas holding company and a Bangladesh operating company pursuing separate listings.',
                    'Bangladesh remains at an early stage in this area. Startup Bangladesh, the Dhaka Stock Exchange, and the Bangladesh Securities and Exchange Commission have been working to create more pathways for local startup listings.',
                ],
            ],
            [
                'question' => 'When do investors get shares?',
                'paragraphs' => [
                    'In Bangladesh, the signed investment agreement, payment, and board resolution establish the commercial completion process, while the share issuance becomes formally recorded after the relevant RJSC filing.',
                    'In Singapore and other jurisdictions, board approvals and statutory shareholder filings determine when the issuance is recorded. The exact completion sequence should always be set out in the transaction documents.',
                ],
            ],
            [
                'question' => 'Can Bangladeshis participate in SPVs?',
                'paragraphs' => [
                    'A local special-purpose vehicle can be formed as a limited company with multiple shareholders and can invest in another company. Investors should account for the possibility of taxation at both the investee-company and SPV levels.',
                    'Participation by Bangladesh residents in a foreign SPV is more complex. Foreign-exchange controls, source-of-funds requirements, banking rules, tax treatment, and platform know-your-customer requirements can all affect whether and how an investment is permitted.',
                ],
                'note' => 'BAN members should obtain independent legal, banking, and tax advice before joining a local or overseas SPV. Informal or incorrectly described transfers should not be used.',
            ],
            [
                'question' => 'How do we monitor the progress of a portfolio?',
                'paragraphs' => [
                    'Monitoring arrangements depend on the preferences of the company and its investor group. BAN works to establish a more consistent reporting cadence while recognizing that investors and founders may also choose to communicate directly.',
                ],
                'bullets' => [
                    'Organize quarterly calls between investors and founders where appropriate.',
                    'Request monthly updates on agreed key metrics and important company developments.',
                    'Use follow-on investor discussions to obtain updated numbers, progress reports, and pitch materials.',
                    'Attend board or shareholder meetings when invited and agreed by the company and investors.',
                ],
            ],
            [
                'question' => 'What legal documents do investors or members need when investing?',
                'paragraphs' => [
                    'The final document set depends on the company, jurisdiction, security, and negotiated terms. A typical equity investment includes three core documents.',
                ],
                'bullets' => [
                    'Term sheet: summarizes the proposed commercial terms but is generally not the final binding investment document.',
                    'Share purchase or subscription agreement: records the investment amount, share issuance, investor rights, representations, and closing mechanics.',
                    'Shareholders agreement: signed by existing and incoming shareholders to define governance, rights, obligations, and relationships among the parties; it is commonly updated for each funding round.',
                ],
            ],
            [
                'question' => 'What tax breaks are available for investing in startups in Bangladesh?',
                'paragraphs' => [
                    'The supplied FAQ states that there is currently no dedicated tax break for investing in Bangladeshi startups. Policy discussions have considered incentives similar to other markets, including relief for eligible investments or losses.',
                    'Existing rebates for qualifying share-market investments may become relevant if more startups list publicly, but investors should confirm the current law and their eligibility with a qualified tax adviser.',
                ],
            ],
            [
                'question' => 'Do investors negotiate terms directly with startups, or does BAN do it on their behalf?',
                'paragraphs' => [
                    'BAN helps facilitate negotiations as an honest broker between the participating investor group and the founders. BAN organizes feedback and supports both sides in reaching clear, workable terms but does not unilaterally dictate the outcome.',
                    'Investors remain responsible for deciding whether the final commercial and legal terms are acceptable to them.',
                ],
            ],
            [
                'question' => 'Does membership cover all financial analysis, or can there be extra costs?',
                'paragraphs' => [
                    'BAN\'s standard diligence includes reviewing the data room, analyzing key ratios, identifying issues, and preparing feedback for the investment memo and investor group. BAN is not an audit firm.',
                    'If investors require a formal financial due-diligence or audit engagement, an external professional firm may be needed at additional cost. That cost may be paid by investors, shared proportionally by a syndicate, or split between founders and investors by agreement.',
                    'BAN can recommend firms, help negotiate fees, provide a diligence checklist, and coordinate the assignment without charging an additional fee beyond its disclosed membership fees and deal commissions.',
                ],
            ],
            [
                'question' => 'Is there a limit on how many startups BAN analyzes each year?',
                'paragraphs' => [
                    'BAN typically undertakes four to five deals per quarter through its normal pipeline, team review, and governing-board selection process.',
                    'If an investor asks BAN to conduct diligence on a company solely for that investor rather than for the wider BAN network, BAN may estimate the work separately and ask the investor, the company, or both to share the cost of the additional diligence time.',
                ],
            ],
            [
                'question' => 'How do investors pay for an investment?',
                'paragraphs' => [
                    'Investors never send investment capital to BAN. Funds are paid directly into the investee company\'s account or into a special-purpose vehicle established for that specific investment, according to the signed closing documents.',
                ],
            ],
            [
                'question' => 'Will BAN create investment contracts for members and startups?',
                'paragraphs' => [
                    'BAN has transaction templates developed from its experience supporting close to 80 transactions at the time of the supplied FAQ. The BAN team can adapt those documents for a transaction.',
                    'A company may also bring its own templates or legal documents. BAN can review and provide guidance on those materials, while the parties should use qualified legal advisers for final legal advice and execution.',
                ],
            ],
            [
                'question' => 'Will BAN manage post-investment communications?',
                'paragraphs' => [
                    'BAN introduces participating investors to one another and to the company, helps establish communication channels, and encourages the company to agree on a regular reporting cadence.',
                    'The BAN team also aims to conduct semi-annual portfolio check-ins, monitor progress for possible follow-on investment, make introductions to later-stage investors, and respond to reasonable ad hoc information requests.',
                    'BAN is a neutral facilitator and does not hold equity on behalf of members, so it cannot lead or enforce communications indefinitely. Over time, investors are encouraged to take an active role, with BAN supporting that transition.',
                ],
            ],
        ];
    }
}
