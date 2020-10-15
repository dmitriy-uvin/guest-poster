export const platformMapper = Platform => ({
    id: Platform.id,
    websiteUrl: Platform.website_url,
    organicTraffic: Platform.organic_traffic,
    doFollowActive: Platform.dofollow_active,
    freeHomeFeaturedActive: Platform.free_home_featured_active,
    nicheEditLinkActive: Platform.niche_edit_link_active,
    articleWritingPrice: Platform.article_writing_price,
    nicheEditLinkPrice: Platform.niche_edit_link_price,
    contacts: Platform.contacts,
    price: Platform.price,
    email: Platform.email,
    comment: Platform.comment,
    articleRequirements: Platform.article_requirements,
    deadLine: Platform.deadline,
    description: Platform.description,
    wherePosted: Platform.where_posted,
    domainZone: Platform.domain_zone,
    createdAt: Platform.created_at,
    updatedAt: Platform.updated_at,
    inTrash: Platform.in_trash,
    trust: Platform.trust,
    spam: Platform.spam,
    lrtPowerTrust: Platform.lrt_power_trust,
    topics: Platform.topics.map(topicMapper),
    moz: MozMapper(Platform.moz),
    alexa: AlexaMapper(Platform.alexa),
    semrush: SemRushMapper(Platform.semrush),
    majestic: MajesticMapper(Platform.majestic),
    fb: Platform.fb,
    ahrefs: Platform.ahrefs
});

export const MozMapper = Moz => ({
    pa: Moz?.pa,
    da: Moz?.da,
    rank: Moz?.rank,
    linksIn: Moz?.links_in,
    equity: Moz?.equity
});

export const AlexaMapper = Alexa => ({
    rank: Alexa?.rank,
    country: Alexa?.country,
    countryRank: Alexa?.country_rank
});

export const SemRushMapper = SemRush => ({
    rank: SemRush?.rank,
    keywordNum: SemRush?.keyword_num,
    trafficCosts: SemRush?.traffic_costs
});

export const MajesticMapper = Majestic => ({
    externalBacklinks: Majestic?.external_backlinks,
    externalGov: Majestic?.external_gov,
    externalEdu: Majestic?.external_edu,
    tf: Majestic?.tf,
    cf: Majestic?.cf,
    refd: Majestic?.refd,
    refdEdu: Majestic?.refd_edu,
    refdGov: Majestic?.refd_gov,
});

export const topicMapper = Topic => ({
    name: Topic.name
});

export const userMapper = User => ({
    id: User.id,
    name: User.name,
    email: User.email,
    skype: User.skype,
    website: User.website,
});

export const orderMapper = Order => ({
    id: Order.id,
    type: Order.type,
    status: Order.order_status,
    comment: Order.comment,
    user: userMapper(Order.user),
    createdAt: Order.created_at,
    totalPrice: Order.total_price,
    items: Order.items.map(item => platformMapper(item[0]))
});
