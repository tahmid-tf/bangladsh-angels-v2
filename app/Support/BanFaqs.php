<?php

namespace App\Support;

class BanFaqs
{
    /**
     * The public FAQ content, adapted from BAN's existing FAQ sheet.
     *
     * @return array<int, array{question: string, paragraphs: array<int, string>, bullets?: array<int, string>, note?: string}>
     */
    public static function all(): array
    {
        return [
            [
                'question' => 'What does BAN actually do?',
                'paragraphs' => [
                    'BAN coordinates the early-stage investment process from founder screening through closing. We look for technology-enabled companies with committed founders, early traction, and a credible path to scale.',
                    'Our team helps selected founders strengthen their pitch, data room, and fundraising strategy before introducing them to members. When investors want to proceed, BAN facilitates meetings, working groups, due diligence, term-sheet alignment, and investment documentation.',
                ],
                'note' => 'BAN is not an asset manager and does not hold members’ investment capital. Investors invest directly in a company or through an agreed special-purpose vehicle; BAN coordinates the process.',
            ],
            [
                'question' => 'What regulations apply, and how does BAN approach compliance?',
                'paragraphs' => [
                    'Bangladesh does not currently use the same accredited-investor framework found in markets such as the United States. BAN structures local transactions and supporting documents in line with applicable Bangladeshi company law and works with qualified advisers where needed.',
                    'Depending on the transaction, investor protections may include pre-emption or first-refusal rights, reserved matters, liquidation preference, anti-dilution provisions, board representation, and agreed governance or filing requirements.',
                ],
            ],
            [
                'question' => 'How do you see exits happening in early-stage investing?',
                'paragraphs' => [
                    'Exit opportunities depend on where the company is incorporated and how it grows. Regionally structured companies may attract strategic buyers or later-stage investors. Bangladesh-based companies may find exits through local conglomerates, venture-capital rounds, acquisitions, or—in suitable cases—the public market.',
                    'Timing and liquidity are never guaranteed. BAN evaluates potential pathways during diligence, but every company and transaction is different.',
                ],
            ],
            [
                'question' => 'What are the common routes to an exit?',
                'paragraphs' => [
                    'An early investor may exit through a secondary sale to another investor, a later financing round, an acquisition of the company, a founder or company buyback, or an eventual public listing.',
                ],
                'bullets' => [
                    'Secondary sale to another angel, institutional investor, or venture fund',
                    'Sale of the company to a strategic or financial buyer',
                    'Founder or company buyback, where legally and commercially feasible',
                    'Initial public offering or another approved public-market route',
                ],
            ],
            [
                'question' => 'Can US-registered startups or SPVs issue K-1 tax forms?',
                'paragraphs' => [
                    'Most BAN portfolio companies have historically been incorporated in Bangladesh or Singapore, although US structures are becoming more common. When a US special-purpose vehicle is used, responsibility for investor tax reporting—including any applicable K-1—will be explained before the investment and usually sits with the SPV manager or platform.',
                ],
            ],
            [
                'question' => 'Why invest through BAN rather than a venture-capital fund?',
                'paragraphs' => [
                    'BAN members make their own deal-by-deal decisions instead of committing capital to a blind-pool fund. This can offer lower entry tickets, direct interaction with founders, and the opportunity to contribute expertise during diligence and after investment.',
                    'A VC fund can offer professional portfolio management and diversification, while direct angel investing requires more active judgment and carries substantial risk. The right structure depends on an investor’s objectives, experience, and risk tolerance.',
                ],
            ],
            [
                'question' => 'When do investors receive shares?',
                'paragraphs' => [
                    'The exact point depends on the company’s jurisdiction and the transaction documents. In Bangladesh, completion typically involves signed agreements, payment, board approvals, and the relevant RJSC filings. In other jurisdictions, the company’s board approvals and statutory filings determine when the issuance is fully recorded.',
                ],
            ],
            [
                'question' => 'Can Bangladeshis participate in special-purpose vehicles (SPVs)?',
                'paragraphs' => [
                    'Local SPVs can be structured as limited companies with multiple shareholders, subject to applicable company and tax rules. Participation in a foreign SPV can involve foreign-exchange, tax, banking, source-of-funds, and know-your-customer requirements.',
                    'Because an investor’s residency and source of funds matter, members should take independent legal and tax advice before joining any local or overseas SPV.',
                ],
            ],
            [
                'question' => 'What criteria does BAN use when evaluating startups?',
                'paragraphs' => [
                    'BAN focuses on scalable, technology-enabled businesses with committed founders, evidence of execution, and a solution that is meaningfully better than available alternatives.',
                ],
                'bullets' => [
                    'Technology is central to how the company creates and delivers value',
                    'At least one full-time founder, with a committed core leadership team',
                    'Early user or customer traction and a credible route to sustainable revenue',
                    'A large, relevant problem and a solution capable of scaling beyond a narrow niche',
                    'A defensible advantage and a funding need that fits BAN’s typical early-stage range',
                    'An independent company rather than a non-core spin-off of an established business',
                ],
            ],
            [
                'question' => 'What legal documents are usually involved in an investment?',
                'paragraphs' => [
                    'The exact document set varies by company and jurisdiction. A typical equity transaction may include the following:',
                ],
                'bullets' => [
                    'A term sheet summarising the proposed commercial terms',
                    'A share purchase or subscription agreement covering the investment and share issuance',
                    'A shareholders’ agreement setting out governance, rights, obligations, and transfer rules',
                    'Corporate approvals, disclosure materials, and any required statutory filings',
                ],
            ],
            [
                'question' => 'Do members negotiate terms directly with startups?',
                'paragraphs' => [
                    'BAN helps coordinate negotiations between the founder and the participating investor group. Members remain responsible for their investment decision, while BAN works to organise diligence, consolidate feedback, and help both sides reach a clear and workable set of terms.',
                ],
            ],
            [
                'question' => 'How is investment money paid?',
                'paragraphs' => [
                    'Investment capital is not paid to BAN. Subject to the agreed structure and closing documents, funds are paid directly to the investee company or to a special-purpose vehicle established for that transaction.',
                ],
            ],
        ];
    }
}
