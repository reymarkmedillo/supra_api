<?php

use Illuminate\Database\Seeder;

class CaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cases')->insert([
            'title'            => "HEDY GAN y YU, Petitioner vs THE HONORABLE COURT OF APPEALS and the PEOPLE OF THE PHILIPPINES, Respondents",
            'scra'             => "",
            'grno'  => "G.R No. L-44264",
            'date' => '1988-09-19',
            'createdBy' => 2,
            'short_title' => 'Hedy Gan Yu vs People of the Philippines',
            'topic' => 'Torts',
            'syllabus' =>  "Doctrine: EMERGENCY RULE.. &quot;Under that rule, one who suddenly finds himself in a place of danger, and is required to act without time to consider the best means that may be adopted to avoid the impending danger, is not guilty of negligence, if he fails to adopt what subsequently and upon reflection may appear to have been a better method, unless the emergency in which he finds himself is brought about by his own negligence.&quot;",
            "body" => "Hedy Gan was driving a Toyota car along North Bay Boulevard, Tondo, Manila.
As accused approached the two vehicles, a jeepney and a truch that were closely
parked from each other, there was a vehicle coming from the opposite direction,
followed by another which tried to overtake the one in front of it and thereby
encroached the lane of the car driven by the accused. To avoid a head-on collision
with the oncoming vehicle, the defendant swerved to the right and as a consequence,
the front bumper of the Toyota Crown Sedan hit an old man who was about to cross
the boulevard and pinned him against the rear of the parked jeepney. The pedestrian
was injured while the Toyota Sedan, the jeepney and the truck suffered damages. The
body of the pedestrian, Isidoro Casino was immediately brought to the hospital but was
pronounced dead on arrival.
CFI Manila convicted petitioner of Homicide thru Reckless Imprudence while
CA modified judgment as homicide thru simple imprudence.
SC reversed CA’s decision and acquitted petitioner applying the emergency
rule.
The Court ruled that the test for determining whether or not a person is
negligent in doing an act whereby injury or damage results to the person or property of
another is this:
Would a prudent man in the position of the person to whom negligence is

attributed foresee harm to the person injured as a reasonable consequence of the
course about to be pursued? If so, the law imposes the duty on the doer to take
precaution against its mischievous results and the failure to do so constitutes
negligence.
Under the circumstances narrated by petitioner, she certainly could not be
expected to act with all the coolness of a person under normal conditions. The danger
confronting petitioner was real and imminent, threatening her very existence. She had
no opportunity for rational thinking but only enough time to heed the very powerful
instinct of self-preservation.
Also, the respondent court itself pronounced that the petitioner was driving her car
within the legal limits. Therefore, the rule that the &quot;emergency rule&quot; enunciated above
applies with full force to the case at bar and consequently absolve petitioner from any
criminal negligence in connection with the incident under consideration.",
            "status" => "reinstated",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        DB::table('cases')->insert([
            'title'              => "AMADO PICART, plaintiff-appellant vs. FRANK SMITH, JR., defendant- appellee",
            'scra'             => "",
            'grno'  => "G.R No. L-12219",
            'date' => '1918-03-15',
            'createdBy' => 2,
            'short_title' => 'Amado Picart vs Frank Smith Jr.',
            'topic' => "Last Clear Chance",
            'syllabus' =>  "DOCTRINE: The last clear chance is a doctrine in the law of torts that is employed in contributory negligence jurisdictions. Under this doctrine, a negligent plaintiff can nonetheless recover if he is able to show that the defendant had the last opportunity to avoid the accident.",
            'body' => "The plaintiff was riding on his pony over the Carlatan bridge in La Union.
Before he had gotten half way across, the defendant approached from the opposite
direction in an automobile, going at the rate of about ten or twelve miles per hour. As
the defendant neared the bridge, he saw the horseman and blew his horn to give
warning of his approach. It appeared to him that the man horseman was not observing
the rule of the road nevertheless, he continued his course. The defendant, instead of
veering to the right while yet some distance away or slowing down, continued to

approach directly toward the horse without diminution of speed. When plaintiff saw the
automobile coming and heard the warning signals,he pulled the pony closely up
against the railing on the right side of the bridge instead of going to the left believing he
did not have sufficient time to get over to the other side. The automobile passed in
such close proximity to the animal that it became frightened and turned its body across
the bridge with its head toward the railing. The horse fell and its rider was thrown off
with some violence. As a result of its injuries the horse died. The plaintiff received
contusions which caused temporary unconsciousness and required medical attention
for several days. 
The La Union CFI absolved the defendant from liability. However, SC reversed
the decision and found defendant to be liable.
The SC ruled that the control of the situation had then passed entirely to the defendant
and it was his duty either to bring his car to an immediate stop or, seeing that there
were no other persons on the bridge, to take the other side and pass sufficiently far
away from the horse to avoid the danger of collision. Instead of doing this, the
defendant ran straight on until he was almost upon the horse. 
The existence of negligence in a given case is not determined by reference to the
personal judgment of the actor in the situation before him. The law considers what
would be reckless, blameworthy, or negligent in the man of ordinary intelligence and
prudence and determines liability by that. 
It goes without saying that the plaintiff himself was not free from fault, for he
was guilty of antecedent negligence in planting himself on the wrong side of the road.
But as we have already stated, the defendant was also negligent; and in such case the
problem always is to discover which agent is immediately and directly responsible. It
will be noted that the negligent acts of the two parties were not contemporaneous,
since the negligence of the defendant succeeded the negligence of the plaintiff by an
appreciable interval. Under these circumstances the law is that the person who has the
last fair chance to avoid the impending harm and fails to do so is chargeable with the
consequences, without reference to the prior negligence of the other party.",
            "status" => "reinstated",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        DB::table('cases')->insert([
            'title'              => "Barredo, petitioner vs. Garcia and Almario, defendants",
            'scra'             => "73 Phil. 607",
            'grno' => "G.R No. L-48006",
            'date' => "1942-07-08",
            'createdBy' => 1,
            'short_title' => 'Barredo vs Garcia and Almario',
            'topic' => "Independent Civil Action",
            'syllabus' =>  "DOCTRINE: Civil Liability from Quasi Delict vs Civil Liability from Crimes. Both are independent from each other. They can be instituted in parallel with each other without prejudice to right against double indemnity.",
            'body' => "Fontanilla’s taxi collided with a “kalesa” thereby killing the 16 year old Faustino Garcia.
Faustino’s parents filed a criminal suit against Fontanilla, the driver of the taxi, and
reserved their right to file a separate civil suit. Fontanilla was eventually convicted.
After the criminal suit, Garcia filed a civil suit against Barredo ,the owner of the taxi and
employer of Fontanilla. The suit was based on Article 1903 of the Civil Code, which
purports the negligence of employers in the selection of their employees. Barredo
assailed the suit arguing that his liability is only subsidiary and that the separate civil
suit should have been filed against Fontanilla primarily and not him.

The Supreme Court ruled that Barredo’s liability is primary
and not subsidiary under Article 1903 which is a separate civil action against negligent
employers. Garcia is well within his rights in suing Barredo. He reserved his right to file
a separate civil action and this is more expeditious because by the time of the SC
judgment, Fontanilla is already serving his sentence and has no property. It was also
proven that Barredo is negligent in hiring his employees because it was shown that
Fontanilla had had multiple traffic infractions already before he hired him, which was
not disputed during the trial. Had Garcia not reserved his right to file a separate civil
action, Barredo would have only been subsidiarily liable. Further, Barredo is not being
sued for damages arising from a criminal act of his driver’s negligence, rather for his
own negligence in selecting his employee.",
            "status" => "reinstated",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        DB::table('cases')->insert([
            'title'     => "PORFIRIO P. CINCO, petitioner-appellant vs. MATEO CANONOY, et. Al, respondents-appellees.",
            'scra'      => "",
            'grno'      => "G.R No. L-33171",
            'date'      => "1997-09-01",
            'createdBy' => 1,
            'short_title' => 'Porfirio P. Cinco vs Mateo Canonoy',
            'topic'     => "",
            "syllabus"  => "DOCTRINE: An action for damages based on Articles 2176 and 2180 of the New Civil Code is quasi-delictual in character which can be prosecuted independently of the criminal action.",
            "body"      => "Petitioner filed a complaint for recovery of damages on account of a vehicular accident
involving his car and a jeepney driven by respondent Romeo Hilo and its
operator.Subsequently, a criminal case was filed against the driver. Counsel for the
respondents moved for the suspension of the civil action pending determination of the
criminal case invoking Section 3(b), Rule 111 of the Rules of Court. The City Court
granted the motion. Petitioner elevated the matter on certiorari in the CFI alleging that
the trial court committed grave abuse of discretion in granting the suspension. CFI also
dismissed the petition, hence, this petition to review on certiorari.
The Supreme Court held that an action for damages based on Articles 2176 and
2180 of the New Civil Code is quasi-delictual in character which can be prosecuted
independently of the criminal action. Where the plaintiff made essential averments in
the complaint that it was the driver&#39;s fault or negligence in the operation of the jeepney
which caused the collision between his automobile and said jeepney while the
defendant-operator in their answer, contended, among others, that
they observed due diligence in the selection and supervision of their employees, a
defense peculiar to actions based on quasi-delict , such action is principally predicated
on Articles 32176 and 2180 of the New Civil Code which is quasi-delictual in natureand
character. Liability being predicated on quasi-delict , the civil case may proceed as a
separate and independent court action as specifically provided for in Article 2177.
The civil action referred to in Section 2(a) and 3(b), Rule 11 of the Rules of Court
which should be suspended after the criminal action has been instituted is that
arising from the criminal offense and not the civil action based on quasi delict.
The concept of quasi-delict enunciated in Article 2176 of the New Civil Code is so
broad that it includes not only injuries to persons but also damage to property. It
makes no distinction between &quot;damage to persons&quot; on the one hand and &quot;damage to
property&quot; on the other. Respondent Judge gravely abused his discretion in upholding

the decision of the city court suspending the civil action based on quasi-delict until
after the criminal action is finally terminated.",
            "status"    => "reinstated",
            "created_at"=> \Carbon\Carbon::now(),
            "updated_at"=> \Carbon\Carbon::now()
        ]);

        DB::table('cases')->insert([
            'title'     => "JOSE CANGCO, plaintiff-appellant vs. MANILA RAILROAD CO., defendant-appellee",
            'scra'      => "38 Phil. 768",
            'grno'      => "G.R No. L-12191",
            'date'      => "1918-10-14",
            'createdBy' => 1,
            'short_title' => 'Jose Cangco vs Manila Railroad Co.',
            'topic'     => "Breach of Contract",
            "syllabus"  => "DOCTRINE: The foundation of the legal liability of the defendant is the contract of carriage, and that the obligation to respond for the damage which plaintiff has suffered arises, if at all, from the breach of that contract by reason of the failure of defendant to exercise due care in its performance. That is to say, its liability is direct and immediate, differing essentially, in legal viewpoint from that presumptive responsibility for the negligence of its servants, imposed by article 1903 of the Civil Code, which can be rebutted by proof of the exercise of due care in their selection and supervision.",
            "body"      => "Cangco was riding the train of Manila Railroad Co (MRC). He was an employee of the
latter and he was given a pass so that he could ride the train for free. When he was
nearing his destination at about 7pm, he arose from his seat even though the train was
not at full stop. When he was about to alight from the train,which was still slightly
moving, he accidentally stepped on a sack of watermelons which he failed to notice
due to the fact that it was dim. This caused him to lose his balance at the door and he
fell and his arm was crushed by the train and he suffered other serious injuries. He
was dragged a few meters more as the train slowed down.
It was established that the employees of MRC were negligent in piling the
sacks of watermelons. MRC raised as a defense the fact that Cangco was also
negligent as he failed to exercise diligence in alighting from the train as he did not wait
for it to stop.
The Supreme Court ruled that Manila Railroad Co is liable for damages and

Cangco was not negligent. Alighting from a  moving train while it is slowing down is a
common practice and a lot of people are doing so every day without suffering injury.
Cangco was also ignorant of the fact that sacks of watermelons were there as there
were no appropriate warnings and the place was dimly lit.
The SC ruled that it can not be doubted that the employees of the railroad company
were guilty of negligence in piling these sacks on the platform in the manner above
stated; that their presence caused the plaintiff to fall as he alighted from the train; and
that they therefore constituted an effective legal cause of the injuries sustained by the
plaintiff. It necessarily follows that the defendant company is liable for the damage
thereby occasioned unless recovery is barred by the plaintiff&#39;s own contributory
negligence, which is absent in the case.
It is important to note that the foundation of the legal liability of the defendant is the
contract of carriage, and that the obligation to respond for the damage which plaintiff
has suffered arises, if at all, from the breach of that contract by reason of the failure of
defendant to exercise due care in its performance. That is to say, its liability is direct
and immediate, differing essentially, in legal viewpoint from that presumptive
responsibility for the negligence of its servants, imposed by article 1903 of the Civil
Code, which can be rebutted by proof of the exercise of due care in their selection and
supervision. Article 1903 of the Civil Code is not applicable to obligations arising ex
contractu, but only to extra-contractual obligations — or to use the technical form of
expression, that article relates only to culpa aquiliana and not to culpa contractual.",
            "status"    => "reinstated",
            "created_at"=> \Carbon\Carbon::now(),
            "updated_at"=> \Carbon\Carbon::now()
        ]);

        DB::table('cases')->insert([
            'title'     => "AIR FRANCE, petitioner vs. RAFAEL CARRASCOSO and the HONORABLE COURT OF APPEALS, respondents",
            'scra'      => "18 SCRA 155",
            'grno'      => "G.R No. L-21438",
            'date'      => "1966-09-28",
            'createdBy' => 1,
            'short_title' => 'Air France vs Rafael Carrascoso',
            'topic'     => "Contracts",
            "syllabus"  => "DOCTRINE: Although the relation of passenger and carrier is &quot;contractual both in origin and nature&quot; nevertheless &quot;the act that breaks the contract may be also a tort.",
            "body"      => "SYNOPSIS: Rafael Carrascoso was one of the 28 Filipino pilgrims who left Manila for
Lourdes. He had a first class round trip ticket from Manila to ROME. However, when
the plane was in Bangkok, the Manager forced him to vacate his first class seat
because there was a &quot;white man&quot;, who, the Manager alleged, had a &quot;better right&quot; to
the seat. Carrascoso filed complaint for damages.The Supreme Court ruled that Air
Frace is liable based on culpa-contractual and on culpa aquiliana.
The Supreme Court ruled that there exists a contract of carriage between Air
France and Carrascoso. There was a contract to furnish Carrasocoso a first class
passage; Second, That said contract was breached when Air France failed to furnish
first class transportation at Bangkok; and Third, that there was bad faith when Air
France’s employee compelled Carrascoso to leave his first class accommodation
berth “after he was already, seated” and to take a seat in the tourist class, by reason of
which he suffered inconvenience, embarrassments and humiliations, thereby causing
him mental anguish, serious anxiety, wounded feelings and social humiliation, resulting
in moral damages.
The Supreme Court did not give credence to Air France’s claim that the
issuance of a first class ticket to a passenger is not an assurance that he will be given
a first class seat. Such claim is simply incredible.
Culpa Aquiliana
Here, the SC ruled, even though there is a contract of carriage between Air
France and Carrascoso, there is also a tortuous act based on culpa aquiliana.
Passengers do not contract merely for transportation. They have a right to be treated
by the carrier’s employees with kindness, respect, courtesy and due consideration.
They are entitled to be protected against personal misconduct, injurious language,
indignities and abuses from such employees. So it is, that any rule or discourteous
conduct on the part of employees towards a passenger gives the latter an action for
damages against the carrier. Air France’s contract with Carrascoso is one attended
with public duty. The stress of Carrascoso’s action is placed upon his wrongful
expulsion. This is a violation of public duty by the Air France — a case of quasi-delict.
Damages are proper.",
            "status"    => "reinstated",
            "created_at"=> \Carbon\Carbon::now(),
            "updated_at"=> \Carbon\Carbon::now()
        ]);

        DB::table('cases')->insert([
            'title'     => "C. S. GILCHRIST, plaintiff-appellee vs. E. A. CUDDY, ET AL., defendants. JOSE FERNANDEZ ESPEJO and MARIANO ZALDARRIAGA, appellants",
            'scra'      => "",
            'grno'      => "G.R No. L-9356",
            'date'      => "1915-02-18",
            'createdBy' => 1,
            'short_title' => 'C.S. Gilchrist vs E. A. Cuddy',
            'topic'     => "Tortuous Interference",
            "syllabus"  => "DOCTRINE: &quot;One who wrongfully interferes in a contract between others, and, for the purpose of gain to himself induces one of the parties to break it, is liable to the party injured thereby; and his continued interference may be ground for an injunction where the injuries resulting will be irreparable.&quot;",
            "body"      => "Respondent is the owner of a cinematographic film “Zigomar”, who let it under a rental
contract to the plaintiff Gilchrist, the owner of a cinematograph theater in Iloilo, for a
specified period of time. In violation of the terms of this agreement, Cuddy proceeded
to turn over the film also under a rental contract, to the defendants Espejo and
Zaldarriaga The arrangement between Cuddy and the appellants for the exhibition of
the film by the latter on the 26th of May were perfected after April 26, so that the six
weeks would include and extend beyond May 26. Gilchrist filed an injunction and
damages for contract interference before CFI, which granted the same restraining the
defendants from exhibiting the film in question in their theatre during the period
specified in the contract of Cuddy with Gilchrist and ruling that defendants are liable for
tortuous interference.

The Supreme Court ruled thatalthough the defendants did not, at the time their
contract was made, know the identity of the plaintiff as the person holding the prior
contract but did know of the existence of a contract in favor of someone. In the case at
bar the only motive for the interference with the Gilchrist - Cuddy contract on the part
of the appellants was a desire to make a profit by exhibiting the film in their theater.
There was no malice beyond this desire; but this fact does not relieve them of the legal
liability for interfering with that contract and causing its breach. It is, therefore, clear,
under the above authorities, that they were liable to Gilchrist for the damages caused
by their acts, unless they are relieved from such liability by reason of the fact that they
did not know at the time the identity of the original lessee (Gilchrist) of the film. 
The Court stated, &quot;Everyone has a right to enjoy the fruits and advantages of his own

enterprise, industry, skill and credit. He has no right to be free from malicious and
wanton interference, disturbance or annoyance. If disturbance or loss come as a result
of competition, or the exercise of like rights by others, it is damnum absque injuria,
unless some superior right by contract or otherwise is interfered with.&quot;",
            "status"    => "reinstated",
            "created_at"=> \Carbon\Carbon::now(),
            "updated_at"=> \Carbon\Carbon::now()
        ]);

        DB::table('cases')->insert([
            'title'     => "EMMA ADRIANO BUSTAMANTE, et. Al,  petitioners vs. THE HONORABLE COURT OF APPEALS, FEDERICO DEL PILAR AND EDILBERTO MONTESIANO,respondents",
            'scra'      => "",
            'grno'      => "89880",
            'date'      => "1991-02-06",
            'createdBy' => 1,
            'short_title' => 'Emma Adriano Bustamante vs Federico del Pilar and Edilberto Montesiano',
            'topic'     => "Contracts",
            "syllabus"  => "DOCTRINE: The doctrine of last clear chance means that even though a person&#39;s own acts may have placed him in a position of peril, and an injury results, the injured person is entitled to recovery.  A person who has the last clear chance or opportunity of avoiding an accident, notwithstanding the negligent acts of his opponent or that of a third person imputed to the opponent is considered in law solely responsible for the consequences of the accident.",
            "body"      => "A collision occurred between a gravel and sand truck and a passenger but there were
approaching each other, coming from the opposite directions of the highway. While the
truck was still about 30 meters away, Susulin, the bus driver, saw the front wheels of
the vehicle wiggling. He also observed that the truck was heading towards his lane.
Not minding this circumstance due to his belief that the driver of the truck was merely
joking, Susulin shifted from fourth to third gear in order to give more power and speed
to the bus, which was ascending the inclined part of the road, in order to overtake or
pass a Kubota hand tractor being pushed by a person along the shoulder of the

highway. While the bus was in the process of overtaking or passing the hand tractor
and the truck was approaching the bus, the two vehicles sideswiped each other at
each other&#39;s left side. Due to the impact, several passengers of the bus were thrown
out and died as a result of the injuries they sustained. RTC found two of the two
drivers solidarily liable for their negligence.CA reversed and set aside the trial court’s
decision, and dismissed the complaint insofar as del Pilar and Montesino are
concerned. SC reversed and set aside the judgment of the CA reinstated that of the
lower court, with the modification on the indemnity for death of each of the victims
which increased to P 50, 000.00 each.
The Supreme Court ruled that the appellate erred in applying the doctrine of
last clear chance as between defendants because the case at bar is not a suit
between the owners and drivers of the colliding vehicles. Therefore, it erred in
absolving the owner and driver of the cargo truck from liability. Furthermore, because
as between defendants, the doctrine cannot be extended into the field of joint
tortfeasors as a test of whether only one of them should be held liable of the injured
person by reason of his discovery of the later’s peril, and it cannot defend by pleading
that another had negligently failed to take action which could have avoided the injury.",
            "status"    => "reinstated",
            "created_at"=> \Carbon\Carbon::now(),
            "updated_at"=> \Carbon\Carbon::now()
        ]);

        DB::table('cases')->insert([
            'title'     => "THE SPOUSES BERNABE AFRICA and SOLEDAD C. AFRICA, and the HEIRS OF DOMINGA ONG, petitioners-appellants vs. CALTEX (PHIL.), INC., MATEO BOQUIREN and THE COURT OF APPEALS, respondents-appellees",
            'scra'      => "",
            'grno'      => "G.R No. L-12986",
            'date'      => "1966-03-31",
            'createdBy' => 1,
            'short_title' => 'The Spouses Africa vs Caltex Philippines',
            'topic'     => "Res Ipsa Loquitur",
            "syllabus"  => "DOCTRINE: Res ipsa Loquitur is a rule to the effect that “where the thing which caused the injury complained of is shown to be under the management of defendant or his servants and the accident is such as in the ordinary course of things does not happen if those who have its management or control use proper care, it affords reasonable evidence, in absence of explanation of defendant, that the incident happened because of want of care.",
            "body"      => "A fire broke out at the Caltex service station in Manila. It started while gasoline was
being hosed from a tank truck into the underground storage, right at the opening of the
receiving truck where the nozzle of the hose was inserted.The fire then spread to and
burned several neighboring houses, including the personal properties and effects
inside them. The owners of the houses, among them petitioners here, sued owner of
the station and agent in charge of operation, Boquiren.
Trial court and CA refused to apply the doctrine of res ipsa loquitur on the grounds that
“as to its applicability xxx in the Philippines, there seems to be nothing definite,” and
that while the rules do not prohibit its adoption in appropriate cases, “in the case at
bar, however, we find no practical use for such docrtrine.”
The Supreme Court reversed appellate court’s decision and applied res ipsa loquitor,
ruling the following:
The aforesaid principle enunciated in Espiritu vs. Philippine Power and Development
Co. is applicable in this case. The gasoline station, with all its appliances, equipment
and employees, was under the control of appellees. A fire occurred therein and spread
to and burned the neighboring houses. The person who knew or could have known
how the fire started were the appellees and their employees, but they gave no
explanation thereof whatsoever. It is fair and reasonable inference that the incident
happened because of want of care. The report by the police officer regarding the fire,
as well as the statement of the driver of the gasoline tank wagon who was transferring
the contents thereof into the underground storage when the fire broke out, strengthen
the presumption of negligence. Verily, (1) the station is in a very busy district and
pedestrians often pass through or mill around the premises; (2) the area is used as a
car barn for around 10 taxicabs owned by Boquiren; (3) a store where people hang out
and possibly smoke cigarettes is located one meter from the hole of the underground
tank; and (4) the concrete walls adjoining the neighborhood are only 2 . meters high at
most and cannot prevent the flames from leaping over it in case of fire.",
            "status"    => "reinstated",
            "created_at"=> \Carbon\Carbon::now(),
            "updated_at"=> \Carbon\Carbon::now()
        ]);

        DB::table('cases')->insert([
            'title'     => "MERCEDES M. TEAGUE, petitioner vs. ELENA FERNANDEZ, et al., respondent",
            'scra'      => "",
            'grno'      => "G.R No. L-29745",
            'date'      => "1973-06-04",
            'createdBy' => 1,
            'short_title' => 'Mercedes M. Teague vs Elena Fernandez',
            'topic'     => "Doctrine of Proximate Cause: Exception",
            "syllabus"  => "DOCTRINE: “The general principle is that the violation of a statute or ordinance is not rendered remote as the cause of an injury by the intervention of another agency if the occurrence of the accident, in the manner in which it happened, was the very thing which the statute or ordinance was intended to prevent.”",
            "body"      => "SYNOPSIS: A fire broke out in a store for surplus materials located about ten meters
away from the Realistic Institute, owned and operated by defendant-appellee
Mercedes M. Teague institute. Upon seeing the fire, some of the students in the
Realistic Institute shouted &#39;Fire! Fire!&#39; and thereafter, a panic ensued. Indeed, no part
of the Gil-Armi Building caught fire. But, after the panic was over, four students,
including Lourdes Fernandez, a sister of plaintiffs-appellants, were found dead and
several others injured on account of the stampede. The deceased&#39;s five brothers and
sisters filed an action for damages against Mercedes M. Teague as owner and
operator of Realistic Institute. The Court of First Instance of Manila found for the
defendant and dismissed the case. CA reversed. The Supreme Court affirmed CA’s
decision, ruling that defendant was negligent and that such negligence was the
proximate cause of the death of Lourdes Fernandez. This finding of negligence is
based primarily on the fact that the provision of Section 491 of the Revised Ordinances
of the City of Manila had not been complied with in connection with the construction
and use of the Gil-Armi building where the petitioner&#39;s vocational school was housed.
The mere fact of violation of a statute is not sufficient basis for an inference that such
violation was the proximate cause of the injury complained. But the violation was a
continuing one, since the ordinance was a measure of safety designed to prevent a
specific situation which would pose a danger to the occupants of the building. That
situation was undue overcrowding in case it should become necessary to evacuate the
building, which, it could be reasonably foreseen, was bound to happen under
emergency conditions if there was only one stairway available.However, if the very
injury has happened which was intended to be prevented by the statute, it has been
held that violation of the statute will be deemed to be proximate cause of the injury.",
            "status"    => "reinstated",
            "created_at"=> \Carbon\Carbon::now(),
            "updated_at"=> \Carbon\Carbon::now()
        ]);

    }
}
