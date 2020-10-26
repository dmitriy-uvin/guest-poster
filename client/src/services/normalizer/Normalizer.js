export const platformMapper = Platform => ({
    id: Platform.id,
    protocol: Platform.protocol,
    websiteUrl: Platform.website_url,
    organicTraffic: Platform.organic_traffic,
    doFollowActive: Platform.dofollow_active,
    freeHomeFeaturedActive: Platform.free_home_featured_active,
    nicheEditLinkActive: Platform.niche_edit_link_active,
    moneyAnchor: Platform.money_anchor,
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
    checktrust: Platform?.trust,
    spam: Platform?.spam,
    powertrust: Platform?.lrt_power_trust,
    topics: Platform.topics.map(topicMapper),
    moz: MozMapper(Platform.moz),
    alexa: AlexaMapper(Platform.alexa),
    semRush: SemRushMapper(Platform.semrush),
    majestic: MajesticMapper(Platform.majestic),
    facebook: FacebookMapper(Platform.fb),
    ahrefs: AhrefsMapper(Platform.ahrefs)
});

export const MozMapper = Moz => ({
    pa: Moz?.pa,
    da: Moz?.da,
    rank: Moz?.rank,
    links_in: Moz?.links_in,
    equity: Moz?.equity
});

export const AlexaMapper = Alexa => ({
    rank: Alexa?.rank,
    country: Alexa?.country,
    country_rank: Alexa?.country_rank
});

export const SemRushMapper = SemRush => ({
    rank: SemRush?.rank,
    keyword_num: SemRush?.keyword_num,
    trafficCosts: SemRush?.traffic_costs
});

export const MajesticMapper = Majestic => ({
    external_backlinks: Majestic?.external_backlinks,
    external_gov: Majestic?.external_gov,
    external_edu: Majestic?.external_edu,
    tf: Majestic?.tf,
    cf: Majestic?.cf,
    refd: Majestic?.refd,
    refd_edu: Majestic?.refd_edu,
    refd_gov: Majestic?.refd_gov,
});

export const topicMapper = Topic => ({
    name: Topic.name
});

export const userMapper = User => ({
    id: User.id,
    name: User.name,
    email: User.email,
    role: User.role,
    skype: User.skype,
    website: User.website,
    emailVerifiedAt: User.email_verified_at
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

export const AhrefsMapper = Ahrefs => ({
    rank: Ahrefs?.rank,
    dr: Ahrefs?.dr,
    ext_backlinks: Ahrefs?.eb,
    refd: Ahrefs?.rd,
    dofollow: Ahrefs?.dofollow
});

export const FacebookMapper = Facebook => ({
    comments: Facebook?.comments,
    reactions: Facebook?.reactions,
    shares: Facebook?.shares,
});
